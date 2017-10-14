<?php

class TrnheaderController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'EmplyeeName', 'HrTransactionNo', 'GetExchagerate', 'DynamicCurrency'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	
	/*
	 * Generate Invoice Number:
	 */
	public function actionHrTransactionNo(){
		$sql="SELECT Fu_GetTrn('HR Transaction','HRTR',6,1) ";
		$cmd=Yii::app()->db->createCommand($sql);
		$result= $cmd -> queryScalar();
		
		//echo $result;
		return $result;
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Trnheader;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;
                
         $model->trnnumber = $this->actionHrTransactionNo();     
         $model->trnyear = date("Y");
         $model->trnperiod = date("m");      

		if(isset($_POST['Trnheader']))
		{
			$model->attributes=$_POST['Trnheader'];
			
			//insert data to hr_detail table
			$trnnumber = $model->trnnumber;
			$empid = $_POST['empid'];
			$salarytype = $_POST['salarytype'];
			$amount = $_POST['amount'];
			$percent = $_POST['percent'];
			$timeofbasic = $_POST['timeofbasic'];
			$areaamt = $_POST['areaamt'];
			$adjustment = $_POST['adjustment'];
			$othour = $_POST['othour'];
			$daydeduction = $_POST['daydeduction'];
			
			$inserttime = $model->inserttime;
			$insertuser = $model->insertuser;

			if($model->save())
			
			$connection=Yii::app()->db;
			foreach( $empid as $key => $n ) {
			  	$sql = "INSERT INTO hr_trndetail (empid, trnnumber, salarytype, amount, percent, timeofbasic, areaamt, adjustment, othour, daydeduction, inserttime, insertuser) 
			  	VALUES ('$n', '$trnnumber', '$salarytype[$key]','$amount[$key]', '$percent[$key]', '$timeofbasic[$key]', '$areaamt[$key]','$adjustment[$key]', '$othour[$key]', '$daydeduction[$key]', '$inserttime', '$insertuser')";
			  	$command=$connection->createCommand($sql);
				$command->execute();
			}
			$this->redirect(array('admin'));
			
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				$model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

		if(isset($_POST['Trnheader']))
		{
			$model->attributes=$_POST['Trnheader'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Trnheader');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Trnheader('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Trnheader']))
			$model->attributes=$_GET['Trnheader'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Trnheader the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Trnheader::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Trnheader $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='trnheader-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionEmplyeeName() 
		{
			
		  if (!empty($_GET['term'])) {
			$sql = 'SELECT empid as value, CONCAT(empid,"-",empname) as label FROM hr_personalinfo WHERE empid LIKE :qterm OR empname LIKE :qterm ';

			$command = Yii::app()->db->createCommand($sql);
			$qterm = '%'.$_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
					
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
		  
		}
		
	public function actionGetExchagerate(){
		
		$q = $_POST['store'];

		$sql = "SELECT b.cm_exchangerate, a.cm_branch, a.cm_currency, b.cm_currency
		            FROM cm_branchmaster a
		            INNER JOIN cm_branchcurrency b ON a.cm_branch = b.cm_branch && a.cm_currency = b.cm_currency
		            WHERE a.cm_branch = '$q' 
		            ";
			$command = Yii::app()->db->createCommand($sql);
		    $result= $command->queryScalar(); 
		    echo $result;
	}

	
	public function actionDynamicCurrency()
    {
		$cm_exchangerate = $_GET['value'];
		
        $data=Branchcurrency::model()->findAll('cm_exchangerate=:cm_exchangerate', 
                      array(':cm_exchangerate'=>$cm_exchangerate));
     
        $data=CHtml::listData($data,'cm_currency','cm_currency');
        foreach($data as $value=>$cm_currency)
        {
            echo CHtml::tag('option',
                       array('value'=>$value),CHtml::encode($cm_currency),true);
        }
    } 
}
