<?php

class InvoicehdController extends Controller
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
				'actions'=>array('create','update', 'actionAdminView'),
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
    private function actionInvoiceNo(){
        $sql="SELECT Fu_GetTrn('Invoice No','IN--',8,0) ";
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
		$model=new Smheader;

        $model->sm_refe_code = $model->sm_number;
        $model->sm_date = date("Y-m-d");
        $model->sm_storeid = Yii::app()->user->employeebranch;
        $model->sm_sign = 1;
        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $adminview = $this->actionAdminView();

		if(isset($_POST['Smheader']))
		{
			$model->attributes=$_POST['Smheader'];
            $model->sm_number = $this->actionInvoiceNo();
            $model->sm_refe_code = $model->sm_number;

			if($model->save()){
                $this->redirect(array('invoicedt/create','sm_number'=>$model->sm_number, 'sm_date'=>$model->sm_date, 'sm_storeid'=>$model->sm_storeid));
                Yii::app()->user->setFlash('success', Yii::t('smheader', 'Success Message : Data Added Successfully !'));
            }else{
                $this->redirect(array('create'));
                Yii::app()->user->setFlash('error', Yii::t('smheader', 'Warning Message: Invalid request !'));
            }

		}

		$this->render('create',array(
			'model'=>$model, 'adminview'=>$adminview,
		));
	}


    private function actionAdminView(){
        $model=new Smheader('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Smheader']))
            $model->attributes=$_GET['Smheader'];

        return $model;
    }

//    private function actionPoNoExist($pp_purordnum){
//        $model = new Purchaseorddt;
//        return $model->exists('pp_purordnum = :pp_purordnum', array(':pp_purordnum'=>$pp_purordnum));
//
//    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
        $model=$this->loadModel($id);
        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $adminview = $this->actionAdminView();

		if(isset($_POST['Smheader']))
		{
			$model->attributes=$_POST['Smheader'];
            if($model->save()){
                $this->redirect(array('create'));
                Yii::app()->user->setFlash('success', Yii::t('smheader', 'Success Message : Updated Successfully !'));
            }else{
                $this->redirect(array('create'));
                Yii::app()->user->setFlash('error', Yii::t('smheader', 'Warning Message: Invalid request !'));
            }
		}

		$this->render('create',array(
			'model'=>$model, 'adminview'=>$adminview,
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
                Yii::app()->user->setFlash('success','Success Message: Data - Deleted Successfully');
            else
                echo "<div class='flash-success'>Success Message: Data - Deleted Successfully</div>";

        }catch(CDbException $e){
            if(!isset($_GET['ajax']))
                Yii::app()->user->setFlash('error','Warning Message: You May Have some Data in Invoice Detail');
            else
                echo "<div class='flash-error'> Warning Message:  You May Have some Data in Invoice Detail </div>"; //for ajax
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
		$dataProvider=new CActiveDataProvider('Smheader');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Smheader('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Smheader']))
			$model->attributes=$_GET['Smheader'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Smheader the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Smheader::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;

	}

	/**
	 * Performs the AJAX validation.
	 * @param Smheader $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='smheader-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
