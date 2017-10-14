<?php

class AdjusthdController extends Controller
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
				'actions'=>array('admin','delete', 'create','update', 'ApproveAdjustment'),
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

    public function actionAdjustmentTransaction(){
        $sql="SELECT Fu_GetTrn('Adjustment Number','AD--',8,0) ";
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
		$model=new Adjusthd;

        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $adjustmentHd = $this->actionAdjustmentHd();

        if(isset($_POST['Adjusthd']))
        {
            $model->attributes=$_POST['Adjusthd'];
            if($model->validate())
            {
                $model->transaction_number = $this->actionAdjustmentTransaction();

                if($model->save()){
                    Yii::app()->user->setFlash('success', Yii::t('adjustment', 'Success Message : Data Added Successfully !'));
                    $this->redirect(array('adjustdt/create','transaction_number'=>$model->transaction_number,
                        'branch'=>$model->branch, ));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('adjustment', 'Warning Message: Invalid request !'));
                    $this->redirect(array('create'));
                }

            }
        }

		$this->render('create',array(
			'model'=>$model, 'adjustmentHd'=>$adjustmentHd,
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

        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $adjustmentHd = $this->actionAdjustmentHd();

        if(isset($_POST['Adjusthd']))
        {
            $model->attributes=$_POST['Adjusthd'];
            if($model->validate())
            {
                if($model->save()){
                    Yii::app()->user->setFlash('success', Yii::t('adjustment', 'Success Message : Data Updated Successfully !'));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('adjustment', 'Warning Message: Invalid request !'));
                }
                $this->redirect(array('create'));
            }
        }

        $this->render('create',array(
			'model'=>$model, 'adjustmentHd'=>$adjustmentHd,
		));
	}

    private function actionAdjustmentHd()
    {
        $model=new Adjusthd('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Adjusthd']))
            $model->attributes=$_GET['Adjusthd'];
        return $model;
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
                Yii::app()->user->setFlash('error',' Warning Message: Invalid request: Adjustment detail data exists !');
            else
                echo "<div class='flash-error'>  Warning Message: Invalid request : Adjustment detail data exists ! </div>";
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
		$dataProvider=new CActiveDataProvider('Adjusthd');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Adjusthd('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Adjusthd']))
			$model->attributes=$_GET['Adjusthd'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Adjusthd the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Adjusthd::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Adjusthd $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='adjusthd-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


    public function actionApproveAdjustment($id, $transaction_number){

        $result = $this->actionAdjustmentExist($transaction_number);

        if($result ==1){
            $sql = sprintf("call sp_im_adjustcon('%s','%s')",
                $id,
                $insertuser = Yii::app()->user->name
            );
            $command  = Yii::app()->db->createCommand($sql);
            $command->execute();
            Yii::app()->user->setFlash('success', Yii::t('adjustment', 'Success Message: Adjustment Confirmed Successfully !'));

        }else{
            Yii::app()->user->setFlash('error', Yii::t('adjustment', 'Warning Message : Detail Entry is not found !'));
        }

        $this->redirect(array('admin'));
    }

    private function actionAdjustmentExist($transaction_number){
        $sql="SELECT 1 FROM im_adjustdt WHERE transaction_number='$transaction_number' ";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();
        return $result;
    }


}
