<?php

class PurchaseorddtController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'GetCmCode', 'PurchaseOrderNumberS', 'PurchaseOrderNumberS1', 'CodeQuantityUnit' ),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','admin','update','delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','update','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id, $pp_purordnum, $pp_status)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),  'pp_purordnum'=>$pp_purordnum, 'pp_status'=>$pp_status
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($pp_purordnum)
	{
		//echo $pp_purordnum;
		$model=new Purchaseorddt;
		
		$model->pp_purordnum = $pp_purordnum;
		
				$this->performAjaxValidation($model);
				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

        $searchDetail = $this->actionSearchDetail($pp_purordnum);

		if(isset($_POST['Purchaseorddt']))
		{
			$model->attributes=$_POST['Purchaseorddt'];
            if($model->validate())
            {
                $pp_purordnum = $model->pp_purordnum;
                $cm_code = $model->cm_code;

                $result = $this->actionCheckPoExist($pp_purordnum, $cm_code);

                if($result == 1){
                    Yii::app()->user->setFlash('error', Yii::t('PurchaseDt', 'Warning Message: Purchase Number and Product Already Exist !'));
                }else{

                    if($model->save()){
                        Yii::app()->user->setFlash('success', Yii::t('PurchaseDt', 'Success Message: Product Added successfully !'));
                    }else{
                        Yii::app()->user->setFlash('error', Yii::t('PurchaseDt', 'Invalid Request !'));
                    }

                }

                $this->redirect(array('create', 'pp_purordnum'=>$model->pp_purordnum,));
            }
		}

		$this->render('create',array(
			'model'=>$model, 'pp_purordnum'=>$pp_purordnum,
            'searchDetail'=>$searchDetail,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id, $pp_purordnum)
	{
		$model=$this->loadModel($id);
		//$model1=$this->loadModel($pp_purordnum);
		
		$this->performAjaxValidation($model);
				$model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

        $searchDetail = $this->actionSearchDetail($pp_purordnum);

        /*
        $sql = "SELECT cm_code FROM pp_purchaseorddt WHERE pp_purordnum='$pp_purordnum' ";
        $command = Yii::app()->db->createCommand($sql);
        $result = $command->queryScalar();
        echo $result;
        */

		if(isset($_POST['Purchaseorddt']))
		{
			$model->attributes=$_POST['Purchaseorddt'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('PurchaseDt', 'Success Message: Updated successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('PurchaseDt', 'Warning Message: Invalid request !'));
            }
				//$this->redirect(array('view','id'=>$model->id));
				$this->redirect(array('create', 'pp_purordnum'=>$pp_purordnum));
		}

		$this->render('create',array(
			'model'=>$model, 'pp_purordnum'=>$pp_purordnum,
            'searchDetail'=>$searchDetail,
		));
	}

    private function actionSearchDetail($pp_purordnum){
        $model=new Purchaseorddt('searchDetail($pp_purordnum)');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Purchaseorddt']))
            $model->attributes=$_GET['Purchaseorddt'];

        return $model;
    }



    private function actionCheckPoExist($pp_purordnum, $cm_code){
        $sql="SELECT 1 FROM pp_purchaseorddt WHERE pp_purordnum='$pp_purordnum' AND cm_code='$cm_code'";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();
        return $result;
    }


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{

        try{
            $this->loadModel($id)->delete();

            if(!isset($_GET['ajax']))
                Yii::app()->user->setFlash('success','Success Message : Data - Deleted Successfully !');
            else
                echo "<div class='flash-success'>Success Message : Data - Deleted Successfully !</div>";

        }catch(CDbException $e){
            if(!isset($_GET['ajax']))
                Yii::app()->user->setFlash('error',' Warning Message: Invalid request !');
            else
                echo "<div class='flash-error'>  Warning Message: Invalid request ! </div>";
        }

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Purchaseorddt');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($pp_purordnum)
	{
		$model=new Purchaseorddt('searchDetail');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Purchaseorddt']))
			$model->attributes=$_GET['Purchaseorddt'];

		$this->render('admin',array(
			'model'=>$model, 'pp_purordnum'=>$pp_purordnum,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Purchaseorddt the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Purchaseorddt::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Purchaseorddt $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='purchaseorddt-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
		public function actionGetCmCode() {
			$res =array();
			//$arr =array();

			if (isset($_GET['term'])) {
				// http://www.yiiframework.com/doc/guide/database.dao
				
				$qtxt ="SELECT Concat(cm_code,'-',cm_name) FROM cm_productmaster WHERE cm_name LIKE :txt";
				$command =Yii::app()->db->createCommand($qtxt);
				$command->bindValue(":txt", '%'.$_GET['term'].'%', PDO::PARAM_STR);
				$res =$command->queryColumn();
				
			}

			echo CJSON::encode($res);
			Yii::app()->end();
			
			
		}
		
		
	public function actionPurchaseOrderNumberS($id){
		
		$dataProvider = new CActiveDataProvider('Purchaseorddt', array(
		    'criteria'=>array(
		        'condition'=> 't.id = ' . $id ,
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));
		
		
		 $this->render('PurchaseOrderNumberS', array('dataProvider' => $dataProvider));
		}
		
		
		
		
	public function actionPurchaseOrderNumberS1( $pp_purordnum, $pp_status ){
		
		$dataProvider = new CActiveDataProvider('Purchaseorddt', array(
		    'criteria'=>array(
		        'condition'=> "t.pp_purordnum = '{$pp_purordnum}'"  ,
		        'select'=> "c.pp_status, t.id, t.pp_purordnum, t.cm_code, t.pp_quantity, t.pp_grnqty, t.pp_unit, t.pp_unitqty, t.pp_purchasrate",
				'join' => "INNER JOIN pp_purchaseordhd c  ON  c.pp_purordnum = t.pp_purordnum ",
				//'group'=>'pp_purordnum',
		    ),
		    //$criteria -> select="t.id, t.identification, t.email, t.numbers, c.numbers";
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));
		
		 $this->render('PurchaseOrderNumberS', array('dataProvider' => $dataProvider, 
		 'pp_purordnum'=>$pp_purordnum, 'pp_status'=>$pp_status ));
		}
		
				
	public function actionCodeQuantityUnit()
        {                     
         if (!empty($_GET['term'])) {
			//$sql = 'SELECT cm_code as id, CONCAT(cm_code," ",cm_name) as value, cm_name as label FROM cm_productmaster WHERE cm_name LIKE :qterm ';
			//$sql = 'SELECT cm_code AS value, cm_name AS label, cm_purunit AS unit FROM cm_productmaster WHERE cm_name LIKE :qterm ';

			$sql = 'SELECT cm_code AS value, cm_name AS label, cm_purunit AS unitofmeasurement,
					ROUND(cm_purconfact) as unitquantity, cm_costprice as purchaserate

			FROM cm_productmaster WHERE cm_name LIKE :qterm ';

			$sql .= ' ORDER BY cm_name ASC';
			$command = Yii::app()->db->createCommand($sql);
			$qterm = $_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
			
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
        }
		
		
		
}
