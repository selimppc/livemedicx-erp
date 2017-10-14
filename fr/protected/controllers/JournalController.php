<?php

class JournalController extends Controller
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
				'actions'=>array('create','update', 'admin','delete', 'createPayment','updatePayment', 'adminPayment',
                    'createReceipt','updateReceipt', 'adminReceipt', 'createReverse','updateReverse', 'adminReverse',
                ),
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

    public function actionOffset(){
        $sql = "SELECT am_offset FROM am_default";
        $command = Yii::app()->db->createCommand($sql);
        $offset = $command->queryScalar();

        return $offset;
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
		$dataProvider=new CActiveDataProvider('Vouhcerheader');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Vouhcerheader the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Vouhcerheader::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Vouhcerheader $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vouhcerheader-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}




    /*
     * ========================================================================================================
     * Journal Voucher
     * ========================================================================================================
     */


    /*
     * Generate Journal Voucher Number:
     */
    public function actionJournalVoucherNo(){
        $sql="SELECT Fu_GetTrn('Voucher No','JV--',8,0) ";
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
        $model=new Vouhcerheader;
        $model2 = new Voucherdetail;

        $year = date("Y");
        $month = date("m");
        $period = 12 + $month - 0;
        if( $period > 12 ){
            $postPeriod = $period - 12;
            $model->am_period = $postPeriod;
        }else{
            $model->am_period = $period;
        }

        if( $period <= 12 ){
            $yearA = $year - 1;
            $model->am_year = $yearA;
        }else{
            $model->am_year = $year;
        }


        $sql = "SELECT am_offset FROM am_default";
        $command = Yii::app()->db->createCommand($sql);
        $offset = $command->queryScalar();

        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $journalvoucher = new Vouhcerheader('searchJournalVoucher');
        $journalvoucher->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $journalvoucher->attributes=$_GET['Vouhcerheader'];


        if(isset($_POST['Vouhcerheader']))
        {
            $model->attributes=$_POST['Vouhcerheader'];
            $model->am_vouchernumber = $this->actionJournalVoucherNo();

            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('journaldt/create', 'am_vouchernumber'=>$model->am_vouchernumber));
        }

        $this->render('create',array(
            'model'=>$model,'model2'=>$model2, 'offset'=>$offset,
            'journalvoucher'=>$journalvoucher,
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
        $model2 = new Voucherdetail;

        $sql = "SELECT am_offset FROM am_default";
        $command = Yii::app()->db->createCommand($sql);
        $offset = $command->queryScalar();

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;


        $journalvoucher = new Vouhcerheader('searchJournalVoucher');
        $journalvoucher->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $journalvoucher->attributes=$_GET['Vouhcerheader'];


        if(isset($_POST['Vouhcerheader']))
        {
            $model->attributes=$_POST['Vouhcerheader'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('create'));
        }

        $this->render('create',array(
            'model'=>$model, 'model2'=>$model2, 'offset'=>$offset,
            'journalvoucher'=>$journalvoucher,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {

        $model=new Vouhcerheader('searchJournalVoucher()');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $model->attributes=$_GET['Vouhcerheader'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }




    /*
     * ========================================================================================================
     * Payment Voucher
     * ========================================================================================================
     */


    /*
     * Generate Payment Voucher Number:
     */
    public function actionPaymentVoucherNo(){
        $sql="SELECT Fu_GetTrn('Voucher No','PAY-',8,0) ";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();

        //echo $result;
        return $result;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreatePayment()
    {
        $model=new Vouhcerheader;
        $model2 = new Voucherdetail;

        $year = date("Y");
        $month = date("m");
        $period = 12 + $month - 0;
        if( $period > 12 ){
            $postPeriod = $period - 12;
            $model->am_period = $postPeriod;
        }else{
            $model->am_period = $period;
        }

        if( $period <= 12 ){
            $yearA = $year - 1;
            $model->am_year = $yearA;
        }else{
            $model->am_year = $year;
        }


        $sql = "SELECT am_offset FROM am_default";
        $command = Yii::app()->db->createCommand($sql);
        $offset = $command->queryScalar();

        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $journalvoucher = new Vouhcerheader('searchPaymentVoucher');
        $journalvoucher->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $journalvoucher->attributes=$_GET['Vouhcerheader'];


        if(isset($_POST['Vouhcerheader']))
        {
            $model->attributes=$_POST['Vouhcerheader'];
            $model->am_vouchernumber = $this->actionPaymentVoucherNo();
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('journaldt/createPayment', 'am_vouchernumber'=>$model->am_vouchernumber));
        }

        $this->render('create_payment',array(
            'model'=>$model,'model2'=>$model2, 'offset'=>$offset,
            'journalvoucher'=>$journalvoucher,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdatePayment($id)
    {
        $model=$this->loadModel($id);
        $model2 = new Voucherdetail;

        $sql = "SELECT am_offset FROM am_default";
        $command = Yii::app()->db->createCommand($sql);
        $offset = $command->queryScalar();

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;


        $journalvoucher = new Vouhcerheader('searchPaymentVoucher');
        $journalvoucher->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $journalvoucher->attributes=$_GET['Vouhcerheader'];


        if(isset($_POST['Vouhcerheader']))
        {
            $model->attributes=$_POST['Vouhcerheader'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('createPayment'));
        }

        $this->render('create_payment',array(
            'model'=>$model, 'model2'=>$model2, 'offset'=>$offset,
            'journalvoucher'=>$journalvoucher,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdminPayment()
    {
        $model=new Vouhcerheader('searchPaymentVoucher');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $model->attributes=$_GET['Vouhcerheader'];

        $this->render('admin_payment',array(
            'model'=>$model,
        ));
    }


    /*
     * ========================================================================================================
     * Receipt Voucher
     * ========================================================================================================
     */


    /*
     * Generate Receipt Voucher Number:
     */
    public function actionReceiptVoucherNo(){
        $sql="SELECT Fu_GetTrn('Voucher No','RCV-',8,0) ";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();

        //echo $result;
        return $result;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateReceipt()
    {
        $model=new Vouhcerheader;
        $model2 = new Voucherdetail;

        $year = date("Y");
        $month = date("m");
        $period = 12 + $month - 0;
        if( $period > 12 ){
            $postPeriod = $period - 12;
            $model->am_period = $postPeriod;
        }else{
            $model->am_period = $period;
        }

        if( $period <= 12 ){
            $yearA = $year - 1;
            $model->am_year = $yearA;
        }else{
            $model->am_year = $year;
        }


        $sql = "SELECT am_offset FROM am_default";
        $command = Yii::app()->db->createCommand($sql);
        $offset = $command->queryScalar();

        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $journalvoucher = new Vouhcerheader('searchReceiptVoucher');
        $journalvoucher->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $journalvoucher->attributes=$_GET['Vouhcerheader'];


        if(isset($_POST['Vouhcerheader']))
        {
            $model->attributes=$_POST['Vouhcerheader'];
            $model->am_vouchernumber = $this->actionReceiptVoucherNo();
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('journaldt/createReceipt', 'am_vouchernumber'=>$model->am_vouchernumber));
        }

        $this->render('create_receipt',array(
            'model'=>$model,'model2'=>$model2, 'offset'=>$offset,
            'journalvoucher'=>$journalvoucher,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateReceipt($id)
    {
        $model=$this->loadModel($id);
        $model2 = new Voucherdetail;

        $sql = "SELECT am_offset FROM am_default";
        $command = Yii::app()->db->createCommand($sql);
        $offset = $command->queryScalar();

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;


        $journalvoucher = new Vouhcerheader('searchReceiptVoucher');
        $journalvoucher->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $journalvoucher->attributes=$_GET['Vouhcerheader'];


        if(isset($_POST['Vouhcerheader']))
        {
            $model->attributes=$_POST['Vouhcerheader'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('createReceipt'));
        }

        $this->render('create_receipt',array(
            'model'=>$model, 'model2'=>$model2, 'offset'=>$offset,
            'journalvoucher'=>$journalvoucher,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdminReceipt()
    {
        $model=new Vouhcerheader('searchReceiptVoucher');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $model->attributes=$_GET['Vouhcerheader'];

        $this->render('admin_receipt',array(
            'model'=>$model,
        ));
    }


    /*
     * ========================================================================================================
     * Reverse Entry
     * ========================================================================================================
     */


    /*
     * Generate Reverse Voucher Number:
     */
    public function actionReverseVoucherNo(){
        $sql="SELECT Fu_GetTrn('Voucher No','REV-',8,0) ";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();

        //echo $result;
        return $result;
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateReverse()
    {
        $model=new Vouhcerheader;
        $model2 = new Voucherdetail;

        $year = date("Y");
        $month = date("m");
        $period = 12 + $month - 0;
        if( $period > 12 ){
            $postPeriod = $period - 12;
            $model->am_period = $postPeriod;
        }else{
            $model->am_period = $period;
        }

        if( $period <= 12 ){
            $yearA = $year - 1;
            $model->am_year = $yearA;
        }else{
            $model->am_year = $year;
        }


        $sql = "SELECT am_offset FROM am_default";
        $command = Yii::app()->db->createCommand($sql);
        $offset = $command->queryScalar();

        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $journalvoucher = new Vouhcerheader('searchReverseVoucher');
        $journalvoucher->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $journalvoucher->attributes=$_GET['Vouhcerheader'];


        if(isset($_POST['Vouhcerheader']))
        {
            $model->attributes=$_POST['Vouhcerheader'];
            $model->am_vouchernumber = $this->actionReverseVoucherNo();
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('journaldt/createReverse', 'am_vouchernumber'=>$model->am_vouchernumber));
        }

        $this->render('create_reverse',array(
            'model'=>$model,'model2'=>$model2, 'offset'=>$offset,
            'journalvoucher'=>$journalvoucher,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateReverse($id)
    {
        $model=$this->loadModel($id);
        $model2 = new Voucherdetail;

        $sql = "SELECT am_offset FROM am_default";
        $command = Yii::app()->db->createCommand($sql);
        $offset = $command->queryScalar();

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;


        $journalvoucher = new Vouhcerheader('searchReverseVoucher');
        $journalvoucher->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $journalvoucher->attributes=$_GET['Vouhcerheader'];


        if(isset($_POST['Vouhcerheader']))
        {
            $model->attributes=$_POST['Vouhcerheader'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('createReverse'));
        }

        $this->render('create_reverse',array(
            'model'=>$model, 'model2'=>$model2, 'offset'=>$offset,
            'journalvoucher'=>$journalvoucher,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdminReverse()
    {
        $model=new Vouhcerheader('searchReverseVoucher');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $model->attributes=$_GET['Vouhcerheader'];

        $this->render('admin_reverse',array(
            'model'=>$model,
        ));
    }



}
