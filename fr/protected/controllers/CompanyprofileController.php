<?php

class CompanyprofileController extends Controller
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
				'actions'=>array('index', ),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','view','admin', 'update', 'delete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'update', 'delete'),
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
		$model=new Companyprofile;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Companyprofile']))
		{
                        //$rnd = rand(0,9999);
			$model->attributes=$_POST['Companyprofile'];
                        
                        $uploadedFile=CUploadedFile::getInstance($model,'photo');
                        //$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                        $fileName = "{$uploadedFile}";  // random number + file name
                        $model->photo = $fileName;
                        
                        Yii::app()->easyImage->thumbOf('photo.png',
                        array(
                            'resize' => array('width' => 100, 'height' => 100),
                            //'rotate' => array('degrees' => 90),
                            'sharpen' => 50,
                            'background' => '#ffffff',
                            'type' => 'jpg',
                            'quality' => 60,
                        ));   
                        
			if($model->save()){
                $uploadedFile->saveAs(Yii::app()->basePath.'/../images/companyprofile/'.$fileName);
                Yii::app()->user->setFlash('success', Yii::t('company', 'Success Message : Data Created Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('company', 'Warning Message: Invalid request !'));
            }

                                
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Companyprofile']))
		{
                    $_POST['Companyprofile']['photo'] = $model->photo;
                    $model->attributes=$_POST['Companyprofile'];
					
                    $uploadedFile=CUploadedFile::getInstance($model,'photo');
                    //$fileName = "{$rnd}-{$uploadedFile}";  // random number + file name
                    $fileName = "{$uploadedFile}";  // random number + file name
                    $model->photo = $fileName;


                    if($model->save()){
                        if(!empty($uploadedFile))  // check if uploaded file is set or not
                        {
                            $uploadedFile->saveAs(Yii::app()->basePath.'/../images/companyprofile/'.$fileName);
                        }
                        Yii::app()->user->setFlash('success', Yii::t('company', 'Success Message : Data Updated Successfully !'));
                    }else{
                        Yii::app()->user->setFlash('error', Yii::t('company', 'Warning Message: Invalid request !'));
                    }
			
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
		$dataProvider=new CActiveDataProvider('Companyprofile');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Companyprofile('search');
		$model->unsetAttributes();  // clear any default values
                
                $command = mysql_query('CALL sp_pp_requisition_insert("v_requisitionno")');
                //$command->execute();
                
		if(isset($_GET['Companyprofile']))
			$model->attributes=$_GET['Companyprofile'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Companyprofile the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Companyprofile::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Companyprofile $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='companyprofile-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	

	


}
