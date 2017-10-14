<?php

class TransferhdController extends Controller
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
				'actions'=>array('index','view', 'ConfirmStatus'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','admin','update','delete', 'StockReceive', 'ConfirmReceived'),
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
	public function actionView($id)
	{
        /*
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));*/

        if (Yii::app()->request->isAjaxRequest)
        {
            //outputProcessing = true because including css-files ...
            $this->renderPartial('view',
                array(
                    'model'=>$this->loadModel($id),
                ),false,true);
            //js-code to open the dialog
            if (!empty($_GET['asDialog']))
                echo CHtml::script('$("#stock_receive").dialog("open")');
            Yii::app()->end();
        }
        else
            $this->render('view', array(
                'model'=>$this->loadModel($id),
            ));
	}

	
	public function actionTranferNo(){
		$sql="SELECT Fu_GetTrn('IM Transfer Number','TRN-',8,0) ";
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
		$model=new Transferhd;

			$model->inserttime = date("Y-m-d H:i");
	        $model->insertuser = Yii::app()->user->name;

        $transaferhd = $this->actionTransferHd();

		if(isset($_POST['Transferhd']))
		{
			$model->attributes=$_POST['Transferhd'];
            $tranferno = $this->actionTranferNo();
            $model->im_transfernum = $tranferno;

            if($model->validate())
            {
                if($model->save()){
                    Yii::app()->user->setFlash('success', Yii::t('transfer', 'Success Message : Data Added Successfully !'));
                    $this->redirect(array('transferdt/create','im_transfernum'=>$model->im_transfernum,
                        'branch'=>$model->im_fromstore,
                    ));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('transfer', 'Warning Message: Invalid request !'));
                    $this->redirect(array('create'));
                }

		    }
        }

		$this->render('create',array(
			'model'=>$model, 'transaferhd'=>$transaferhd,
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

				$model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

        $transaferhd = $this->actionTransferHd();

		if(isset($_POST['Transferhd']))
		{
			$model->attributes=$_POST['Transferhd'];
            if($model->validate())
            {
                if($model->save()){
                    Yii::app()->user->setFlash('success', Yii::t('transfer', 'Success Message : Data Updated Successfully !'));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('transfer', 'Warning Message: Invalid request !'));
                }
				$this->redirect(array('create'));
		    }
        }

		$this->render('create',array(
			'model'=>$model, 'transaferhd'=>$transaferhd,
		));
	}

    private function actionTransferHd()
    {
        $model=new Transferhd('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Transferhd']))
            $model->attributes=$_GET['Transferhd'];
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
		$dataProvider=new CActiveDataProvider('Transferhd');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Transferhd('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Transferhd']))
			$model->attributes=$_GET['Transferhd'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Transferhd the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Transferhd::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Transferhd $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='transferhd-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    private function actionTransferExist($im_transfernum){
        $model = new Transferdt;
        return $model->exists('im_transfernum = :im_transfernum', array(':im_transfernum'=>$im_transfernum));

    }
	
	public function actionConfirmStatus($id){

			//$sql = sprintf("call sp_im_TransferConfirm('%s','%s')",
            $sql = sprintf("call sp_im_trn_dispatch('%s','%s')",
                       $id,
                       $insertuser = Yii::app()->user->name
					);
 
               $command  = Yii::app()->db->createCommand($sql);
               $command->execute();

            Yii::app()->user->setFlash('success', Yii::t('Transfer', 'Success Message: Transfer Order Confirmed Successfully !'));

			$this->redirect(array('admin'));

		
		}

    public function actionStockReceive()
    {
       $user = Yii::app()->user->employeebranch;

        $model=new Transferhd('stockReceive($user)');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Transferhd']))
            $model->attributes=$_GET['Transferhd'];

        $this->render('stock_recieve',array(
            'model'=>$model, 'user'=>$user,
        ));
    }

    public function actionConfirmReceived($id){

        $sql = sprintf("call sp_im_trn_receive('%s','%s')",
            $id,
            $insertuser = Yii::app()->user->name
        );

        $command  = Yii::app()->db->createCommand($sql);
        $command->execute();

        Yii::app()->user->setFlash('success', Yii::t('Transfer', 'Success Message: Receive Confirmed Successfully !'));

        $this->redirect(array('stockReceive'));


    }

}
