<?php

class ReporticoModule extends CWebModule
{
    public $engine;
    private $_assetsUrl;

    public function preinit()
    {
    }

    function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias('application.modules.reportico.assets') );
        return $this->_assetsUrl;
    }

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'reportico.models.*',
            'reportico.components.*',
            'reportico.components.reportico',
        ));

        $component=Yii::createComponent(
            array(
            //component details here
                'class' => 'reportico',
                'peter' => "peter"
            ));
        $this->setComponent("reportico", $component) ;
    }

    // Create an instance of a reportico generator for Yii
    public function getReporticoEngine()
    {
        $this->engine = new reportico();

        $x =  Yii::app()->getUrlManager() ;
        $type = Yii::app()->getUrlManager()->getUrlFormat();
        if ( Yii::app()->getUrlManager()->getUrlFormat() == "get" )
        {
            $this->engine->reportico_ajax_script_url = $_SERVER["SCRIPT_NAME"];
            $this->engine->forward_url_get_parameters = "r=reportico/reportico/ajax";
            $this->engine->forward_url_get_parameters_graph = "r=reportico/reportico/graph";
            $this->engine->forward_url_get_parameters_dbimage = "r=reportico/reportico/dbimage";
            $this->engine->reportico_ajax_mode = 1;
        }
        else
        {
            $this->engine->reportico_ajax_script_url = $_SERVER["SCRIPT_NAME"]."/reportico/reportico/ajax";
            $this->engine->forward_url_get_parameters = false;
            $this->engine->forward_url_get_parameters_graph = "r=reportico/reportico/graph";
            $this->engine->forward_url_get_parameters_dbimage = "r=reportico/reportico/dbimage";
            $this->engine->reportico_ajax_mode = 2;
        }
        $this->engine->embedded_report = true;
        $this->engine->allow_debug = true;
        $this->engine->framework_parent = "yii";
        $this->engine->external_user = Yii::app()->user->id;
        $this->engine->url_path_to_assets = $this->getAssetsUrl();

        // Set Joomla Database Access Config from configuration
        if ( !defined("SW_FRAMEWORK_DB_DRIVER") )
        {
            // Extract Yii database elements from connection string 
            $driver = "mysql";
            $host = "127.0.0.1";
            $dbname = "unnknown";
            if ( Yii::app()->db->connectionString )
            {
                $dbelements  = explode(':', Yii::app()->db->connectionString);
                if ( count($dbelements) > 1 )
                {
                    $driver = $dbelements[0];
                    $dbconbits = explode(";", $dbelements[1]);
                    if ( preg_match("/mysql/", $driver ) )
                        $driver = "pdo_mysql";

                    foreach ( $dbconbits as $value )
                    {
                        $after = substr(strstr($value, "="), 1);
                        $pos = strpos($value, "=");
                        if ( $pos )
                        {
                            $k = substr($value, 0, $pos);
                            $v = substr($value, $pos + 1);
                            if ( $k == "host" || $k == "hostname" ) 
                                $host = $v;
                            if ( $k == "dbname" || $k == "database" ) 
                                $dbname = $v;
                        }
                    }
                }
            }
            define('SW_FRAMEWORK_DB_DRIVER', $driver);
            define('SW_FRAMEWORK_DB_USER',Yii::app()->db->username);
            define('SW_FRAMEWORK_DB_PASSWORD',Yii::app()->db->password);

            define('SW_FRAMEWORK_DB_HOST',$host);
            define('SW_FRAMEWORK_DB_DATABASE',$dbname);
        }

        return $this->engine;
    }    

    // Generate output
    public function generate()
    {
        $this->engine->execute();
    }
}
