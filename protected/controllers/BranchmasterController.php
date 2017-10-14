<?php

class BranchmasterController extends Controller
{
	
	
	const ACTIVE_YES = 1;
    const ACTIVE_NO = 0;
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
				'actions'=>array('index','view', 'BranchCurrency'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create', 'admin','update','delete'),
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
	public function actionView($cm_branch)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($cm_branch), 'cm_branch'=>$cm_branch,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Branchmaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

		if(isset($_POST['Branchmaster']))
		{
			$model->attributes=$_POST['Branchmaster'];

            try{
                $model->save();
                Yii::app()->user->setFlash('success', Yii::t('branchmaster', 'Success Message : Data Added Successfully !'));
                $this->redirect(array('admin'));
            }catch(CDbException $e){
                Yii::app()->user->setFlash('error', Yii::t('branchmaster', 'Warning Message: Invalid request ! Branch already exist!'));
                $this->redirect(array('create'));
            }
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
	public function actionUpdate($cm_branch)
	{
		$model=$this->loadModel($cm_branch);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				$model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

		if(isset($_POST['Branchmaster']))
		{
			$model->attributes=$_POST['Branchmaster'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('branchmaster', 'Success Message : Data updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('branchmaster', 'Warning Message: Error !'));
            }
				$this->redirect(array('admin','cm_branch'=>$model->cm_branch));
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
	public function actionDelete($cm_branch)
	{


        try{
            $this->loadModel($cm_branch)->delete();

            if(!isset($_GET['ajax']))
                Yii::app()->user->setFlash('success','Success Message : Data - Deleted Successfully');
            else
                echo "<div class='flash-success'>Success Message : Data - Deleted Successfully</div>";

        }catch(CDbException $e){
            if(!isset($_GET['ajax']))
                Yii::app()->user->setFlash('error','Warning Message: Invalid request  !');
            else
                echo "<div class='flash-error'> Warning Message: Invalid request  ! </div>"; //for ajax
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
		$dataProvider=new CActiveDataProvider('Branchmaster');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Branchmaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Branchmaster']))
			$model->attributes=$_GET['Branchmaster'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Branchmaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Branchmaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Branchmaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='branchmaster-form')
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
        
        
	public function actionBranchCurrency(){
		
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="Currency"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));

		 $this->render('currency', array('dataProvider' => $dataProvider));
		}
}
