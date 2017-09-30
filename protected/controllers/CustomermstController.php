<?php

class CustomermstController extends Controller
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
				'actions'=>array('create','update','admin','delete', 'ManageCustomerGroup', 'AutocompleteTest', 'CusCode'),
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
	public function actionView($cm_cuscode)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($cm_cuscode),
		));
	}
	
	//Generate Customer Transaction Number
	public function actionCusCode($p){

		$sql="SELECT Fu_GetTrn('Customer TRN Number', '$p' ,4,0) ";
		$cmd=Yii::app()->db->createCommand($sql);
		$result= $cmd -> queryScalar();

		return $result;
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Customermst;

				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;
                //$country = "RWA";
                $model->country_code = Transaction::model()->find('cm_type=:cm_type', array(':cm_type'=>'Customer TRN Number'))->cm_trncode;

		if(isset($_POST['Customermst']))
		{
			$model->attributes=$_POST['Customermst'];
            //Number Generating...
            $s = $model->cm_territory;
            $trn = $_POST['Customermst']['country_code'];
            //$p = $trn."-".$s."-";
            $r = $this->actionCusCode($trn);
			$p = substr($r,0,4).$s."-".substr($r,4);
			$model->cm_cuscode = $p;
            //$model->cm_cuscode = $r;

			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('customer', 'Success Message : Data Created Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('customer', 'Warning Message: Invalid request !'));
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
	public function actionUpdate($cm_cuscode)
	{
		$model=$this->loadModel($cm_cuscode);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				$model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;
		
		if(isset($_POST['Customermst']))
		{
			$model->attributes=$_POST['Customermst'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('customer', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('customer', 'Warning Message: Invalid request !'));
            }
				$this->redirect(array('view','cm_cuscode'=>$model->cm_cuscode));
		}

		$this->render('update',array(
			'model'=>$model,'cm_cuscode'=>$cm_cuscode,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($cm_cuscode)
	{
        try{
            $this->loadModel($cm_cuscode)->delete();

            if(!isset($_GET['ajax']))
                Yii::app()->user->setFlash('success','Success Message : Data - Deleted Successfully !');
            else
                echo "<div class='flash-success'>Success Message : Data - Deleted Successfully !</div>";

        }catch(CDbException $e){
            if(!isset($_GET['ajax']))
                Yii::app()->user->setFlash('error',' Warning Message: Delete Transaction details, before deleting header Information !');
            else
                echo "<div class='flash-error'>  Warning Message:  Delete Transaction details, before deleting header Information ! </div>";
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
		$dataProvider=new CActiveDataProvider('Customermst');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Customermst('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Customermst']))
			$model->attributes=$_GET['Customermst'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Customermst the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($cm_cuscode)
	{
		$model=Customermst::model()->findByPk($cm_cuscode);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Customermst $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='customermst-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	

	public function actionAutocompleteTest() {
			
		if (!empty($_GET['term'])) {
		
				$sql = "SELECT am_accountcode as value, am_description as label
		            FROM am_chartofaccounts 
		            WHERE am_accountcode LIKE :qterm OR am_description LIKE :qterm";
				$sql .= ' ORDER BY label ASC';
				$command = Yii::app()->db->createCommand($sql);
				$qterm = '%'.$_GET['term'].'%';
				$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
				$result = $command->queryAll();
				
				echo CJSON::encode($result); exit;
			  } else {
				return false;
			  }
		}

	
	
	
	
	
	
	
	
}
