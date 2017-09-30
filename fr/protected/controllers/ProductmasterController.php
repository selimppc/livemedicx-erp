<?php

class ProductmasterController extends Controller
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
				'actions'=>array('index','view', 'ProductClass', 'ProductGroup', 'ProductCategory', 'UnitOfMeasurement', 'getImage1'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','admin', 'delete', 'update', 'service', 'UpdateService'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'delete', 'update'),
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
	public function actionView($cm_code)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($cm_code),
		));
	}

	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Productmaster;

                $model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

		if(isset($_POST['Productmaster']))
		{
			$model->attributes=$_POST['Productmaster'];
			try{
                $model->save();
                Yii::app()->user->setFlash('success', Yii::t('Product', 'Success Message : Data Added Successfully !'));
            }catch(CDbException $e){
                Yii::app()->user->setFlash('error', Yii::t('Product', 'Warning Message: Invalid request ! Product code already exist!'));
            }

			$this->redirect(array('create'));
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
	public function actionUpdate($cm_code)
	{
		$model=$this->loadModel($cm_code);

                $model->cm_code = $cm_code;
                $model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

        if(isset($_POST['Productmaster']))
        {
            $model->attributes=$_POST['Productmaster'];

            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('Product', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('Product', 'Warning Message: Invalid request !'));
            }
				$this->redirect(array('view','cm_code'=>$model->cm_code));
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
	public function actionDelete($cm_code)
	{

        try{
            $this->loadModel($cm_code)->delete();

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
		$dataProvider=new CActiveDataProvider('Productmaster');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		$model=new Productmaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Productmaster']))
			$model->attributes=$_GET['Productmaster'];
			
			
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Productmaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Productmaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Productmaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='productmaster-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	
	
	public function actionProductClass(){
		
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="Product Class"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));

		 $this->render('class', array('dataProvider' => $dataProvider));
		}
		
	public function actionProductGroup(){
		
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="Product Group"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));

		 $this->render('group', array('dataProvider' => $dataProvider));
		}
		
	public function actionProductCategory(){
		
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="Product Category"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));

		 $this->render('category', array('dataProvider' => $dataProvider));
		}
		
		
	public function actionUnitOfMeasurement(){
		
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="Unit Of Measurement"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));

		 $this->render('unit_measure', array('dataProvider' => $dataProvider));
		}

    /*
     * ====================================================================
     * Service Product Area
     * ====================================================================
     */
	public function actionService(){
        $model=new Productmaster;

        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $data = new CActiveDataProvider('Productmaster', array(
            'criteria'=>array(
                'condition'=>'cm_class="SERVICE"',
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));

        if(isset($_POST['Productmaster']))
        {
            $model->attributes=$_POST['Productmaster'];

            try{
                $model->save();
                Yii::app()->user->setFlash('success', Yii::t('service', 'Success Message : Data Added Successfully !'));
            }catch(CDbException $e){
                Yii::app()->user->setFlash('error', Yii::t('service', 'Warning Message: Invalid request ! Service Code already exist ! '));
            }

            $this->redirect(array('service'));
        }

        $this->render('service',array(
            'model'=>$model, 'data'=>$data,
        ));
    }

    public function actionUpdateService($cm_code){
        $model=$this->loadModel($cm_code);

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $data = new CActiveDataProvider('Productmaster', array(
            'criteria'=>array(
                'condition'=>'cm_class="SERVICE"',
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));

        if(isset($_POST['Productmaster']))
        {
            $model->attributes=$_POST['Productmaster'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('Product', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('Product', 'Warning Message: Invalid request !'));
            }
            $this->redirect(array('service'));
        }

        $this->render('service',array(
            'model'=>$model, 'data'=>$data,
        ));
    }

    function getImage1($imageVal) {
        if ($imageVal != null)
            return CHtml::image($imageVal, '', array('style' => 'width:40px;height:40px;',));
    }
}
