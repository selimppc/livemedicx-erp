<?php

class GrouptwoController extends Controller
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
				'actions'=>array('create','update','admin','delete', 'CreateGroupTwo'),
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
	public function actionCreate($group1)
	{
		$model=new Grouptwo;
		
		$model->am_groupone = $group1;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				$model->inserttime = date("Y-m-d H:i");
	        	$model->insertuser = Yii::app()->user->name;

        	if(isset($_POST['submit']))
	        {
		        if(isset($_POST['Grouptwo']))
				{
					$model->attributes=$_POST['Grouptwo'];
					if($model->save()){
                        Yii::app()->user->setFlash('success', Yii::t('group', 'Success Message : Data Added Successfully !'));
                    }else{
                        Yii::app()->user->setFlash('error', Yii::t('group', 'Warning Message: Invalid request !'));
                    }
						$this->redirect(array('grouptwo/create', 'group1'=>$group1 ));
				}
	        }
	        
	        if(isset($_POST['proceed']))
	        {
		        if(isset($_POST['Grouptwo']))
					{
						$model->attributes=$_POST['Grouptwo'];
						if($model->save()){
                            Yii::app()->user->setFlash('success', Yii::t('group', 'Success Message : Data Added Successfully !'));
                        }else{
                            Yii::app()->user->setFlash('error', Yii::t('group', 'Warning Message: Invalid request !'));
                        }
							$this->redirect(array('groupthree/create','group1'=>$model->am_groupone, 'group2'=>$model->am_grouptwo));
					}
	        }
		

		$this->render('create',array(
			'model'=>$model, 'group1'=>$group1,
		));
	}

    public function actionCreateGroupTwo()
    {
        $model=new Grouptwo;

       //$model->am_groupone = $group1;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        if(isset($_POST['submit']))
        {
            if(isset($_POST['Grouptwo']))
            {
                $model->attributes=$_POST['Grouptwo'];
                if($model->save()){
                    Yii::app()->user->setFlash('success', Yii::t('group', 'Success Message : Data Added Successfully !'));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('group', 'Warning Message: Invalid request !'));
                }
                $this->redirect(array('grouptwo/create', 'group1'=>$group1 ));
            }
        }

        if(isset($_POST['proceed']))
        {
            if(isset($_POST['Grouptwo']))
            {
                $model->attributes=$_POST['Grouptwo'];
                if($model->save()){
                    Yii::app()->user->setFlash('success', Yii::t('group', 'Success Message : Data Added Successfully !'));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('group', 'Warning Message: Invalid request !'));
                }
                $this->redirect(array('groupthree/create','group1'=>$model->am_groupone, 'group2'=>$model->am_grouptwo));
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
	public function actionUpdate($id, $group1)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				$model->updatetime = date("Y-m-d H:i");
	        	$model->updateuser = Yii::app()->user->name;

		if(isset($_POST['Grouptwo']))
		{
			$model->attributes=$_POST['Grouptwo'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('group', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('group', 'Warning Message: Invalid request !'));
            }
				$this->redirect(array('create', 'group1'=>$group1));
		}

		$this->render('create',array(
			'model'=>$model, 'group1'=>$group1,
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
		$dataProvider=new CActiveDataProvider('Grouptwo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Grouptwo('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Grouptwo']))
			$model->attributes=$_GET['Grouptwo'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Grouptwo the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Grouptwo::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Grouptwo $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='grouptwo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
