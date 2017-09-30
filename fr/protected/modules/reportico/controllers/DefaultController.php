<?php
class DefaultController extends Controller
{
    public $engine = false;
    public $partialRender = true;

    function __construct($id,$module=null) {
        $this->engine = $module->getReporticoEngine();
        $this->partialRender = Yii::app()->request->getQuery("partialReportico", true);
        parent::__construct($id,$module);
    }

	public function actionIndex()
	{
		$this->engine->access_mode = "FULL";
		$this->engine->initial_execute_mode = "ADMIN";
		$this->engine->initial_project = "admin";
		$this->engine->initial_report = false;
		$this->engine->clear_reportico_session = true;
		if ( $this->partialRender )
		    $this->renderPartial('reportico.views.reportico.index');
		else
		    $this->render('reportico.views.reportico.index');
	}

	public function actionLogin()
	{
		$this->render('index');
	}
}
