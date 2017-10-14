<?php

class JournaldtController extends Controller
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
				'actions'=>array('create','update', 'admin','delete', 'GetExchangeRate',
                    'createPayment','updatePayment','createReceipt','updateReceipt','createReverse','updateReverse',
                    'PostToGl', 'AdminView', 'AdminViewPayment', 'AdminViewReceipt', 'AdminViewReverse',
                    'PostToGlAp', 'PostToGlRp', 'PostToGlRv',
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
		$dataProvider=new CActiveDataProvider('Voucherdetail');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Voucherdetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Voucherdetail']))
			$model->attributes=$_GET['Voucherdetail'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionAdminView($am_vouchernumber)
    {

        $model=new Vwvoucher('search');

        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Vwvoucher']))
            $model->attributes=$_GET['Vwvoucher'];

        $this->render('admin_view',array(
            'model'=>$model, 'am_vouchernumber'=>$am_vouchernumber,
        ));
    }

    public function actionAdminViewPayment($am_vouchernumber)
    {

        $model=new Vwvoucher('search');

        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Vwvoucher']))
            $model->attributes=$_GET['Vwvoucher'];

        $this->render('admin_view_payment',array(
            'model'=>$model, 'am_vouchernumber'=>$am_vouchernumber,
        ));
    }

    public function actionAdminViewReceipt($am_vouchernumber)
    {

        $model=new Vwvoucher('search');

        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Vwvoucher']))
            $model->attributes=$_GET['Vwvoucher'];

        $this->render('admin_view_receipt',array(
            'model'=>$model, 'am_vouchernumber'=>$am_vouchernumber,
        ));
    }

    public function actionAdminViewReverse($am_vouchernumber)
    {

        $model=new Vwvoucher('search');

        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Vwvoucher']))
            $model->attributes=$_GET['Vwvoucher'];

        $this->render('admin_view_reverse',array(
            'model'=>$model, 'am_vouchernumber'=>$am_vouchernumber,
        ));
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Voucherdetail the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Voucherdetail::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Voucherdetail $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='voucherdetail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionGetExchangeRate()
    {

        $q = $_POST['store'];

        $sql = "SELECT cm_exchangerate as value FROM cm_currency WHERE cm_currency= '$q' ";
        $command = Yii::app()->db->createCommand($sql);
        $result= $command->queryScalar();
        echo $result;
    }


    /*
     * ======================================================================================================
     * Journal Voucher Detail
     * ======================================================================================================
     */


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($am_vouchernumber)
    {
        $model=new Voucherdetail;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $journaldt = new Voucherdetail('searchdt("$am_vouchernumber")');
        $journaldt->unsetAttributes();  // clear any default values
        if(isset($_GET['Voucherdetail']))
            $journaldt->attributes=$_GET['Voucherdetail'];


        $model->am_vouchernumber = $am_vouchernumber;


        $sql = "SELECT SUM(am_primeamt) as primeamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $primeamt= $command->queryScalar();

        $sql = "SELECT SUM(am_baseamt) as baseamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $baseamt= $command->queryScalar();


        if(isset($_POST['Voucherdetail']))
        {
            $model->attributes=$_POST['Voucherdetail'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('create','am_vouchernumber'=>$model->am_vouchernumber));
        }

        $this->render('create',array(
            'model'=>$model, 'journaldt'=>$journaldt,
            'am_vouchernumber'=>$am_vouchernumber,
            'primeamt'=>$primeamt, 'baseamt'=>$baseamt,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id, $am_vouchernumber)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $journaldt = new Voucherdetail('searchdt("$am_vouchernumber")');
        $journaldt->unsetAttributes();  // clear any default values
        if(isset($_GET['Voucherdetail']))
            $journaldt->attributes=$_GET['Voucherdetail'];

        $sql = "SELECT SUM(am_primeamt) as primeamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $primeamt= $command->queryScalar();

        $sql = "SELECT SUM(am_baseamt) as baseamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $baseamt= $command->queryScalar();


        if(isset($_POST['Voucherdetail']))
        {
            $model->attributes=$_POST['Voucherdetail'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('create','am_vouchernumber'=>$model->am_vouchernumber));
        }

        $this->render('create',array(
            'model'=>$model,'journaldt'=>$journaldt,
            'am_vouchernumber'=>$am_vouchernumber,
            'primeamt'=>$primeamt, 'baseamt'=>$baseamt,
        ));
    }


    /*
    * ======================================================================================================
    * Payment Voucher Detail
    * ======================================================================================================
    */

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreatePayment($am_vouchernumber)
    {
        $model=new Voucherdetail;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $journaldt = new Voucherdetail('searchdt("$am_vouchernumber")');
        $journaldt->unsetAttributes();  // clear any default values
        if(isset($_GET['Voucherdetail']))
            $journaldt->attributes=$_GET['Voucherdetail'];


        $model->am_vouchernumber = $am_vouchernumber;


        $sql = "SELECT SUM(am_primeamt) as primeamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $primeamt= $command->queryScalar();

        $sql = "SELECT SUM(am_baseamt) as baseamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $baseamt= $command->queryScalar();


        if(isset($_POST['Voucherdetail']))
        {
            $model->attributes=$_POST['Voucherdetail'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('createPayment','am_vouchernumber'=>$model->am_vouchernumber));
        }

        $this->render('create_payment',array(
            'model'=>$model, 'journaldt'=>$journaldt,
            'am_vouchernumber'=>$am_vouchernumber,
            'primeamt'=>$primeamt, 'baseamt'=>$baseamt,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdatePayment($id, $am_vouchernumber)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $journaldt = new Voucherdetail('searchdt("$am_vouchernumber")');
        $journaldt->unsetAttributes();  // clear any default values
        if(isset($_GET['Voucherdetail']))
            $journaldt->attributes=$_GET['Voucherdetail'];

        $sql = "SELECT SUM(am_primeamt) as primeamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $primeamt= $command->queryScalar();

        $sql = "SELECT SUM(am_baseamt) as baseamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $baseamt= $command->queryScalar();


        if(isset($_POST['Voucherdetail']))
        {
            $model->attributes=$_POST['Voucherdetail'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('createPayment','am_vouchernumber'=>$model->am_vouchernumber));
        }

        $this->render('create_payment',array(
            'model'=>$model,'journaldt'=>$journaldt,
            'am_vouchernumber'=>$am_vouchernumber,
            'primeamt'=>$primeamt, 'baseamt'=>$baseamt,
        ));
    }




    /*
    * ======================================================================================================
    * Receipt Voucher Detail
    * ======================================================================================================
    */


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateReceipt($am_vouchernumber)
    {
        $model=new Voucherdetail;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $journaldt = new Voucherdetail('searchdt("$am_vouchernumber")');
        $journaldt->unsetAttributes();  // clear any default values
        if(isset($_GET['Voucherdetail']))
            $journaldt->attributes=$_GET['Voucherdetail'];


        $model->am_vouchernumber = $am_vouchernumber;


        $sql = "SELECT SUM(am_primeamt) as primeamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $primeamt= $command->queryScalar();

        $sql = "SELECT SUM(am_baseamt) as baseamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $baseamt= $command->queryScalar();


        if(isset($_POST['Voucherdetail']))
        {
            $model->attributes=$_POST['Voucherdetail'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('createReceipt','am_vouchernumber'=>$model->am_vouchernumber));
        }

        $this->render('create_receipt',array(
            'model'=>$model, 'journaldt'=>$journaldt,
            'am_vouchernumber'=>$am_vouchernumber,
            'primeamt'=>$primeamt, 'baseamt'=>$baseamt,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateReceipt($id, $am_vouchernumber)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $journaldt = new Voucherdetail('searchdt("$am_vouchernumber")');
        $journaldt->unsetAttributes();  // clear any default values
        if(isset($_GET['Voucherdetail']))
            $journaldt->attributes=$_GET['Voucherdetail'];

        $sql = "SELECT SUM(am_primeamt) as primeamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $primeamt= $command->queryScalar();

        $sql = "SELECT SUM(am_baseamt) as baseamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $baseamt= $command->queryScalar();


        if(isset($_POST['Voucherdetail']))
        {
            $model->attributes=$_POST['Voucherdetail'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('createReceipt','am_vouchernumber'=>$model->am_vouchernumber));
        }

        $this->render('create_receipt',array(
            'model'=>$model,'journaldt'=>$journaldt,
            'am_vouchernumber'=>$am_vouchernumber,
            'primeamt'=>$primeamt, 'baseamt'=>$baseamt,
        ));
    }



    /*
    * ======================================================================================================
    * Reverse Entry Detail
    * ======================================================================================================
    */

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateReverse($am_vouchernumber)
    {
        $model=new Voucherdetail;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $journaldt = new Voucherdetail('searchdt("$am_vouchernumber")');
        $journaldt->unsetAttributes();  // clear any default values
        if(isset($_GET['Voucherdetail']))
            $journaldt->attributes=$_GET['Voucherdetail'];


        $model->am_vouchernumber = $am_vouchernumber;


        $sql = "SELECT SUM(am_primeamt) as primeamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $primeamt= $command->queryScalar();

        $sql = "SELECT SUM(am_baseamt) as baseamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $baseamt= $command->queryScalar();


        if(isset($_POST['Voucherdetail']))
        {
            $model->attributes=$_POST['Voucherdetail'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('createReverse','am_vouchernumber'=>$model->am_vouchernumber));
        }

        $this->render('create_reverse',array(
            'model'=>$model, 'journaldt'=>$journaldt,
            'am_vouchernumber'=>$am_vouchernumber,
            'primeamt'=>$primeamt, 'baseamt'=>$baseamt,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateReverse($id, $am_vouchernumber)
    {
        $model=$this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $journaldt = new Voucherdetail('searchdt("$am_vouchernumber")');
        $journaldt->unsetAttributes();  // clear any default values
        if(isset($_GET['Voucherdetail']))
            $journaldt->attributes=$_GET['Voucherdetail'];

        $sql = "SELECT SUM(am_primeamt) as primeamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $primeamt= $command->queryScalar();

        $sql = "SELECT SUM(am_baseamt) as baseamt FROM am_voucherdetail WHERE am_vouchernumber= '$am_vouchernumber' ";
        $command = Yii::app()->db->createCommand($sql);
        $baseamt= $command->queryScalar();


        if(isset($_POST['Voucherdetail']))
        {
            $model->attributes=$_POST['Voucherdetail'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message: Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Warning Message: Invalid Request !'));
            }
            $this->redirect(array('createReverse','am_vouchernumber'=>$model->am_vouchernumber));
        }

        $this->render('create_reverse',array(
            'model'=>$model,'journaldt'=>$journaldt,
            'am_vouchernumber'=>$am_vouchernumber,
            'primeamt'=>$primeamt, 'baseamt'=>$baseamt,
        ));
    }



//'AdminView', 'AdminViewPayment', 'AdminViewReceipt', 'AdminViewReverse',
    //Store Procedure for POST TO GL

    public function actionPostToGl($am_vouchernumber){

            $sql = sprintf("call sp_am_voucherpost('%s','%s')",
                $am_vouchernumber,
                $insertuser = Yii::app()->user->name
            );
            $command  = Yii::app()->db->createCommand($sql);
            $command->execute();
            Yii::app()->user->setFlash('success', Yii::t('post', 'Success Message: Data Posted to GL Successfully !'));

        //$this->redirect(Yii::app()->request->urlReferrer);
        $this->redirect(array('AdminView','am_vouchernumber'=>$am_vouchernumber));
    }
    public function actionPostToGlAp($am_vouchernumber){

        $sql = sprintf("call sp_am_voucherpost('%s','%s')",
            $am_vouchernumber,
            $insertuser = Yii::app()->user->name
        );
        $command  = Yii::app()->db->createCommand($sql);
        $command->execute();
        Yii::app()->user->setFlash('success', Yii::t('post', 'Success Message: Data Posted to GL Successfully !'));

        //$this->redirect(Yii::app()->request->urlReferrer);
        $this->redirect(array('AdminViewPayment','am_vouchernumber'=>$am_vouchernumber));
    }
    public function actionPostToGlRp($am_vouchernumber){

        $sql = sprintf("call sp_am_voucherpost('%s','%s')",
            $am_vouchernumber,
            $insertuser = Yii::app()->user->name
        );
        $command  = Yii::app()->db->createCommand($sql);
        $command->execute();
        Yii::app()->user->setFlash('success', Yii::t('post', 'Success Message: Data Posted to GL Successfully !'));

        //$this->redirect(Yii::app()->request->urlReferrer);
        $this->redirect(array('AdminViewReceipt','am_vouchernumber'=>$am_vouchernumber));
    }
    public function actionPostToGlRv($am_vouchernumber){

        $sql = sprintf("call sp_am_voucherpost('%s','%s')",
            $am_vouchernumber,
            $insertuser = Yii::app()->user->name
        );
        $command  = Yii::app()->db->createCommand($sql);
        $command->execute();
        Yii::app()->user->setFlash('success', Yii::t('post', 'Success Message: Data Posted to GL Successfully !'));

        //$this->redirect(Yii::app()->request->urlReferrer);
        $this->redirect(array('AdminViewReverse','am_vouchernumber'=>$am_vouchernumber));
    }

}
