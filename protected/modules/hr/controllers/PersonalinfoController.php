<?php

class PersonalinfoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	const ACTIVE_YES = 1;
    const ACTIVE_NO = 0;

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
				'actions'=>array('create','update', 'GetCurrency', 'CreatePosition', 'AdminPosition', 'CreateDepartment', 'AdminDepartment', 'CreateDesignation', 'AdminDesignation', 'CreateBankCash', 'AdminBankCash', 'CreateLeavePlan', 'AdminLeavePlan', 'CreateSalaryType', 'AdminSalaryType'),
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Personalinfo;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

		if(isset($_POST['Personalinfo']))
		{
			$model->attributes=$_POST['Personalinfo'];
			if($model->save())
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

		if(isset($_POST['Personalinfo']))
		{
			$model->attributes=$_POST['Personalinfo'];
			if($model->save())
				$this->redirect(array('admin'));
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
		$dataProvider=new CActiveDataProvider('Personalinfo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Personalinfo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Personalinfo']))
			$model->attributes=$_GET['Personalinfo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Personalinfo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Personalinfo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Personalinfo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='personalinfo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function getActiveOptions(){
            return array(
            self::ACTIVE_YES => 'Yes',
            self::ACTIVE_NO => 'No',
            );
        }
        
	
	
	public function actionGetCurrency()
		{
		  
			$q = $_POST['store'];
		   	
			$sql = "SELECT cm_exchangerate as value FROM cm_branchcurrency WHERE cm_currency= '$q' ";
			$command = Yii::app()->db->createCommand($sql);
		    $result= $command->queryScalar(); 
		    echo $result;
		}
		
		
	/*===================================================================
	 * 
	 * Settings => Position
	 * 
	 * ==================================================================
	 */
		public function actionCreatePosition()
		{
		    $model=new Codesparam;
		    
		    		$model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;
	
		    if(isset($_POST['Codesparam']))
			{
				$model->attributes=$_POST['Codesparam'];
				if($model->save())
					$this->redirect(array('AdminPosition'));
			}
	                
		    $this->render('create_position',array('model'=>$model));
		} 
		
	public function actionAdminPosition()
	{
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="Position"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array('pageSize'=>20,),
		));

		 $this->render('admin_position', array('dataProvider' => $dataProvider));
	}
	
	
	/*===================================================================
	 * 
	 * Settings => Department
	 * 
	 * ==================================================================
	 */
		public function actionCreateDepartment()
		{
		    $model=new Codesparam;
		    
		    		$model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;
	
		    if(isset($_POST['Codesparam']))
			{
				$model->attributes=$_POST['Codesparam'];
				if($model->save())
					$this->redirect(array('AdminDepartment'));
			}
	                
		    $this->render('create_department',array('model'=>$model));
		} 
		
	public function actionAdminDepartment()
	{
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="Department"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array('pageSize'=>20,),
		));

		 $this->render('admin_department', array('dataProvider' => $dataProvider));
	}
	
	
	
	
	/*===================================================================
	 * 
	 * Settings => Designation
	 * 
	 * ==================================================================
	 */
		public function actionCreateDesignation()
		{
		    $model=new Codesparam;
		    
		    		$model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;
	
		    if(isset($_POST['Codesparam']))
			{
				$model->attributes=$_POST['Codesparam'];
				if($model->save())
					$this->redirect(array('AdminDesignation'));
			}
	                
		    $this->render('create_designation',array('model'=>$model));
		} 
		
	public function actionAdminDesignation()
	{
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="Designation"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array('pageSize'=>20,),
		));

		 $this->render('admin_designation', array('dataProvider' => $dataProvider));
	}
	
	
	
	
	
	/*===================================================================
	 * 
	 * Settings => Bank / Cash
	 * 
	 * ==================================================================
	 */
		public function actionCreateBankCash()
		{
		    $model=new Codesparam;
		    
		    		$model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;
	
		    if(isset($_POST['Codesparam']))
			{
				$model->attributes=$_POST['Codesparam'];
				if($model->save())
					$this->redirect(array('AdminBankCash'));
			}
	                
		    $this->render('create_bankcash',array('model'=>$model));
		} 
		
	public function actionAdminBankCash()
	{
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="BankCash"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array('pageSize'=>20,),
		));

		 $this->render('admin_bankcash', array('dataProvider' => $dataProvider));
	}
	
	
	

	
	
	/*===================================================================
	 * 
	 * Settings => Leave Plan
	 * 
	 * ==================================================================
	 */
		public function actionCreateLeavePlan()
		{
		    $model=new Codesparam;
		    
		    		$model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;
	
		    if(isset($_POST['Codesparam']))
			{
				$model->attributes=$_POST['Codesparam'];
				if($model->save())
					$this->redirect(array('AdminLeavePlan'));
			}
	                
		    $this->render('create_leaveplan',array('model'=>$model));
		} 
		
	public function actionAdminLeavePlan()
	{
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="Leave Plan"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array('pageSize'=>20,),
		));

		 $this->render('admin_leaveplan', array('dataProvider' => $dataProvider));
	}
	
	
	
	
	
	
	/*===================================================================
	 * 
	 * Settings => Salary Type
	 * 
	 * ==================================================================
	 */
		public function actionCreateSalaryType()
		{
		    $model=new Codesparam;
		    
		    		$model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;
	
		    if(isset($_POST['Codesparam']))
			{
				$model->attributes=$_POST['Codesparam'];
				if($model->save())
					$this->redirect(array('AdminSalaryType'));
			}
	                
		    $this->render('create_salarytype',array('model'=>$model));
		} 
		
	public function actionAdminSalaryType()
	{
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="Salary Type"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array('pageSize'=>20,),
		));

		 $this->render('admin_salarytype', array('dataProvider' => $dataProvider));
	}
	
	
		
}
