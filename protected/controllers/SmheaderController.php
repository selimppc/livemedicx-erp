<?php

class SmheaderController extends Controller
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
				'actions'=>array('index','admin', 'create', 'view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','admin','update','delete', 'invoiceno', 'autocompletetest', 'AutocompleteTestNew',
                    'customercode','SalesReturnNo', 'CreateSalesReturn', 'AdminSalesReturn', 'createmoneyreceipt',
                    'adminmoneyreceipt', 'moneyreceipt', 'AdminManageSalesReturn', 'SalesManageDetails', 'ApproveStatus',
                    'DeliveryOrder','OrdDeliverd', 'AutocompleteBankCash', 'PostToGl', 'MrPostToGl', 'InvoiceDetail',
                    'CancelInvoice', 'AdminMrAlc', 'ManageMoneyReceipt','ViewMrAlc', 'CancelMoneyReceipt',
                    'ApproveMr', 'DirectSale', 'DirectSaleAdmin', 'approveDirectSale', 'cancelDirectSale',
                ),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'create','update'),
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
	
	
	/* =======================================================================
	 * 
	 *  INVOICE AREA
	 *  
	 * ======================================================================== */ 
	 
	
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
		$model = new Smheader;
		//$Smdetail = new Smdetail;

		//$invoiceno = $model->sm_number = "IN140009";

		$model->sm_refe_code = $model->sm_number;
		$model->sm_date = date("Y-m-d");
		$model->sm_storeid = Yii::app()->user->employeebranch; 
		
				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;
	               
		if(isset($_POST['Smheader']))
		{

			$model->attributes=$_POST['Smheader'];
            $model->sm_number = $this->actionInvoiceNo();

            if(isset($_POST['cm_code'])){
                $sm_number = $model->sm_number;
                $cm_code = $_POST['cm_code'];
                $sm_unit = $_POST['sm_unit'];
                $sm_rate = $_POST['sm_rate'];
                $sm_bonusqty = "0";
                $sm_quantity = $_POST['sm_quantity'];
                $sm_tax_rate = $_POST['sm_tax_rate'];
                $sm_lineamt = $_POST['sm_lineamt'];
                $sm_tax_amt = "0" ;
                $inserttime = $model->inserttime;
                $insertuser = $model->insertuser;


                $connection=Yii::app()->db;


                if($model->save())
                {
                    foreach( $cm_code as $key => $n ) {
                        $sql = "INSERT INTO sm_detail (cm_code, sm_number, sm_unit, sm_rate, sm_bonusqty, sm_quantity, sm_tax_rate, sm_tax_amt, sm_lineamt, inserttime, insertuser)
                        VALUES ('$n', '$sm_number', '$sm_unit[$key]','$sm_rate[$key]', '$sm_bonusqty[$key]', '$sm_quantity[$key]', '$sm_tax_rate[$key]', '$sm_tax_amt','$sm_lineamt[$key]', '$inserttime', '$insertuser')";
                        $command=$connection->createCommand($sql);
                        $command->execute();
                    }
                    Yii::app()->user->setFlash('success', Yii::t('smheader', 'Success Message : Data Added Successfully !'));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('smheader', 'Warning Message: Invalid request !'));
                }
                    $this->redirect(array('admin'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('smheader', 'Warning Message: You Could Not Add Any Items !'));
                $this->redirect(array('create'));
            }
		}

		$this->render('create_invoice',array(
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

		if(isset($_POST['Smheader']))
		{
			$model->attributes=$_POST['Smheader'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('smheader', 'Success Message : Data Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('smheader', 'Warning Message: Invalid request !'));
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
                Yii::app()->user->setFlash('error',' Warning Message: Delete voucher details, before deleting voucher header !');
            else
                echo "<div class='flash-error'>  Warning Message: Delete voucher details, before deleting voucher header! </div>";
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

		$this->render('admin_invoice',array(
			'model'=>$model,
		));
	}

    public function actionCancelInvoice($id){
        $model=new Smheader;

        $sql = "UPDATE sm_header SET sm_stataus = 'Cancel' WHERE id = '$id'";
        $command  = Yii::app()->db->createCommand($sql);
        $command->execute();

        Yii::app()->user->setFlash('success', Yii::t('Smheader', 'Canceled Successfully !'));

        $this->redirect(array('admin'));

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
		if(isset($_POST['ajax']) && $_POST['ajax']==='sm-header-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function actionAutocompleteTest() {

		if (!empty($_GET['term'])) {
		
				$sql = "SELECT t.cm_name as label, t.cm_code as code, t.cm_sellrate as rate, t.cm_stkunit as unit, t.cm_selltax as tax, r.cm_code, SUM(r.available) as available
		            FROM cm_productmaster t 
		            INNER JOIN im_vw_stock r ON t.cm_code = r.cm_code 
		            WHERE t.cm_name LIKE :qterm ";
					//WHERE t.cm_name LIKE :qterm AND r.im_storeid='$storeid'	";
				$sql .= ' ORDER BY label ASC';
				$command = Yii::app()->db->createCommand($sql);
				$qterm = '%'.$_GET['term'].'%';
				$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
				$result = $command->queryAll();
				
				echo CJSON::encode($result); exit;
			  } else {
				return false;
			  }
		}
		
	public function actionAutocompleteTestNew() {

        $productClass = $_GET['productClass'];
        $warehouse = $_GET['warehouse'];
		$date = date("Y-m-d");

        if($productClass == 'PRODUCT'){
            if (!empty($_GET['term'])) {

                $sql = "SELECT t.cm_name as label, t.cm_code as code, t.cm_sellrate as rate, t.cm_stkunit as unit, t.cm_selltax as tax, r.cm_code, SUM(available) as available
		            FROM cm_productmaster t
		            INNER JOIN im_vw_stock r ON t.cm_code = r.cm_code
		            WHERE r.im_storeid='$warehouse' AND r.im_ExpireDate >='$date' AND t.cm_name LIKE :qterm
		            GROUP BY r.cm_code";

                $sql .= ' ORDER BY label ASC';
                $command = Yii::app()->db->createCommand($sql);
                $qterm = $_GET['term'].'%';
                //$command->bindValue(":qterm", $_GET['term'].'%', PDO::PARAM_STR);
                $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
                $result = $command->queryAll();

                echo CJSON::encode($result); exit;

            } else {
                return false;
            }
        }elseif($productClass == 'SERVICE'){
            if (!empty($_GET['term'])) {

                $sql = "SELECT cm_name as label, cm_code as code, cm_sellrate as rate, cm_stkunit as unit, cm_selltax as tax, cm_sellconfact as available
		            FROM cm_productmaster
		            WHERE cm_class='SERVICE' AND cm_name LIKE :qterm ";

                $sql .= ' ORDER BY label ASC';
                $command = Yii::app()->db->createCommand($sql);
                $qterm = $_GET['term'].'%';
                $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
                $result = $command->queryAll();

                echo CJSON::encode($result); exit;
            } else {
                return false;
            }
        }

		}
	
	public function actionCustomerCode() {
		
		if (!empty($_GET['term'])) {
		$sql = "SELECT cm_cuscode as value, cm_name as label, cm_branch as branch, cm_sp as sp,c_status FROM cm_customermst  WHERE c_status='Open' AND cm_name LIKE :qterm ";
				// $sql = "SELECT cm_cuscode as value, cm_name as label, cm_branch as branch, cm_sp as sp
		  //           FROM cm_customermst 
		  //           WHERE cm_name LIKE :qterm ";
				$sql .= ' ORDER BY label ASC';
				$command = Yii::app()->db->createCommand($sql);
				$qterm = $_GET['term'].'%';
				$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
				$result = $command->queryAll();
				
				echo CJSON::encode($result); exit;
			  } else {
				return false;
			  }
		}
	
	
		public function actionApproveStatus($id, $sm_number){

            $result = $this->actionInvoiceExist($sm_number);
            if($result == 1){
                $sql = sprintf("call sp_sm_doconfirm('%s','%s')",
                    $id,
                    $insertuser = Yii::app()->user->name
                );
                $command  = Yii::app()->db->createCommand($sql);
                $command->execute();

                Yii::app()->user->setFlash('success', Yii::t('Smheader', 'Invoice Confirmed Successfully. Approved to Delivery !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('Smheader', 'Items are not available. Please add invoice details before Confirm !'));
            }

			$this->redirect(array('admin'));
		}


    private function actionInvoiceExist($sm_number){
        $model = new Smdetail;
        return $model->exists('sm_number = :sm_number', array(':sm_number'=>$sm_number));

    }
		
		
	/* =======================================================================
	 * 
	 *  SALES RETURN AREA
	 *  
	 * ======================================================================== */ 
	
	/*
	 * Generate Sales Return:
	 */
    private function actionSalesReturnNo(){
		$sql="SELECT Fu_GetTrn('Sales Return','SR--',8,0) ";
		$cmd=Yii::app()->db->createCommand($sql);
		$result= $cmd -> queryScalar();
		
		//echo $result;
		return $result;
	}
		
	public function actionCreateSalesReturn($sm_number)
	 {
		$model = new Smheader;

		
		$sql = "SELECT sm_number, cm_code, sm_batchnumber, sm_expdate, sm_unit, sm_sellrate, sm_rate, sm_quantity, sm_tax_rate, sm_line_amt, cm_name
		        FROM sm_vw_sm_batchsale
		        WHERE sm_number = '$sm_number'";
			$command = Yii::app()->db->createCommand($sql);
			$smdetail = $command->queryAll();

			
		$smheader = Smheader::model()->findByAttributes(array('sm_number' =>$sm_number));	

		$model->cm_cuscode = $smheader->cm_cuscode;
		$model->sm_sp = $smheader->sm_sp;
		$model->sm_storeid = $smheader->sm_storeid;
		$model->sm_refe_code = $sm_number;
        $sm_date = $smheader->sm_date;

        $sql = "SELECT cm_name FROM cm_customermst WHERE cm_cuscode='$smheader->cm_cuscode'";
        $command = Yii::app()->db->createCommand($sql);
        $customerName = $command->queryScalar();

		$model->sm_date = date("Y-m-d");
		$model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;
	               
		if(isset($_POST['Smheader']))
		{
			
			$model->attributes=$_POST['Smheader'];
            $model->sm_number = $this->actionSalesReturnNo();

            if(isset($_POST['cm_code'])){
                $sm_number = $model->sm_number;
                $cm_code = $_POST['cm_code'];
                $sm_batchnumber = $_POST['sm_batchnumber'];
                $sm_ref_code = $_POST['sm_ref_code'];

                $sm_expdate = $_POST['sm_expdate'];
                $sm_unit = $_POST['sm_unit'];
                $sm_rate = $_POST['sm_rate'];
                $sm_quantity = $_POST['sm_quantity'];
                $sm_tax_rate = $_POST['sm_tax_rate'];
                $sm_lineamt = $_POST['sm_lineamt'];
                $sm_sellrate = $_POST['sm_sellrate'];

                $inserttime = $model->inserttime;
                $insertuser = $model->insertuser;


                if($model->save()){
                    $connection=Yii::app()->db;

                    foreach( $cm_code as $key => $n ) {
                        $sql = "INSERT INTO sm_batchsale (cm_code, sm_number, sm_batchnumber, sm_expdate, sm_unit, sm_rate, sm_sellrate, sm_quantity, sm_tax_rate, sm_line_amt, inserttime, insertuser, sm_ref_code)
			  	VALUES ('$n', '$sm_number', '$sm_batchnumber[$key]', '$sm_expdate[$key]', '$sm_unit[$key]','$sm_rate[$key]', '$sm_sellrate[$key]', '$sm_quantity[$key]', '$sm_tax_rate[$key]', '$sm_lineamt[$key]', '$inserttime', '$insertuser', '$sm_ref_code')";
                        $command=$connection->createCommand($sql);
                        $command->execute();
                    }
                    Yii::app()->user->setFlash('success', Yii::t('smheader', 'Success Message : Data Added Successfully !'));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('smheader', 'Warning Message: Invalid request !'));
                }
                $this->redirect(array('adminsalesreturn'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('smheader', 'Warning Message: You Could Not Add Any Items !'));
                $this->redirect(array('createsalesreturn', 'sm_number'=>$sm_number));
            }

		}

		$this->render('create_sales_return',array(
			'model'=>$model, 'smdetail'=>$smdetail, 'smheader'=>$smheader, 'sm_number'=>$sm_number,
            'sm_date'=>$sm_date, 'customerName'=>$customerName,
		));
	 }
	 
	/**
	 * Manages Sales Return .
	 */
	public function actionAdminSalesReturn()
	{
		
		$model= new Smheader('searchReturn');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Smheader']))
			$model->attributes=$_GET['Smheader'];

		$this->render('admin_sales_return',array(
			'model'=>$model,
		));
	}
	
	
	public function actionAdminManageSalesReturn()
	{
		$model= new Smheader('searchManageReturn');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Smheader']))
			$model->attributes=$_GET['Smheader'];

		$this->render('admin_manage_sales_return',array(
			'model'=>$model,
		));
	}
	
	public function actionInvoiceDetail($sm_number){
		
		$model= new Smdetail('searchInvoiceDetail');
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Smdetail']))
			$model->attributes=$_GET['Smdetail'];

		$this->render('admin_invoice_detail',array(
			'model'=>$model, 'sm_number'=>$sm_number,
		));
	}
	
	public function actionSalesManageDetails($sm_number)
	{
		$dataProvider = new CActiveDataProvider('Smbatchsale', array(
			    'criteria'=>array(
					'params' => array(':sm_number'=>$sm_number)
			    ),
			    'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
	
		$this->render('admin_manage_details', array('dataProvider' => $dataProvider, 'sm_number'=>$sm_number));
	}
	
	/* =======================================================================
	 * 
	 *  MONEY RECEIPT AREA
	 *  
	 * ======================================================================== */ 
	
	public function actionAdminMoneyReceipt(){

		$model=new Smvwcusreceivable('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Smvwcusreceivable']))
			$model->attributes=$_GET['Smvwcusreceivable'];
		
		$this->render('admin_money_receipt',array(
			'model'=>$model,
		));
	}

    public function actionManageMoneyReceipt()
    {

        $model= new Smheader('searchMoneyReceipt');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Smheader']))
            $model->attributes=$_GET['Smheader'];

        $this->render('manage_money_receipt',array(
            'model'=>$model,
        ));
    }
	
	/*
	 * Generate Sales Return:
	 */
    private function actionMoneyReceipt(){
		$sql="SELECT Fu_GetTrn('Money Receipt','MR--',8,0) ";
		$cmd=Yii::app()->db->createCommand($sql);
		$result= $cmd -> queryScalar();
		
		//echo $result;
		return $result;
	}
	
	
	public function actionCreateMoneyReceipt($cm_code, $cm_name, $sm_branch,$sm_inv,$sm_date){
		$model = new Smheader;
		$vwmralc = new Smvwmralc;
		$indate;

		$model->sm_date = $sm_date;
		$model->cm_cuscode = $cm_code;
		$cname = Customermst::model()->findByAttributes(array('cm_cuscode'=>$cm_code))->cm_name;
		$model->sm_sp =  $cname;

        $model->sm_storeid = $sm_branch;
		
		$model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

		//$mralc = Smvwmrrcv::model()->findAll(array('cm_cuscode = "$cm_code"')) ;
		$sql = "SELECT * FROM sm_vw_mrrcv WHERE cm_cuscode= '$cm_code' AND sm_branch='$sm_branch' ";
		$command = Yii::app()->db->createCommand($sql);
		$mralc = $command->queryAll();
		foreach($mralc as $value){ $indate=$value['sm_date'];break;}
		
		$sql = "SELECT SUM(sm_amount) as ramt FROM sm_vw_mrrcv WHERE cm_cuscode= '$cm_code' AND sm_branch='$sm_branch' ";
		$command = Yii::app()->db->createCommand($sql);
		$ramt = $command->queryScalar();
		
		if(isset($_POST['Smheader']))
		{

			$model->attributes=$_POST['Smheader'];
            $model->sm_number = $this->actionMoneyReceipt();

            if(isset($_POST['sm_invnumber'])){
                $sm_number = $model->sm_number;
                $sm_invnumber = $_POST['sm_invnumber'];
                $sm_amount = $_POST['sm_amount'];

                $sm_balanceamt = $model->sm_totalamt;

                $inserttime = $model->inserttime;
                $insertuser = $model->insertuser;
				
				    $udate=$model->sm_date;
					$indate;
					$udate=str_replace('-','',$udate);
					$indate=str_replace('-','',$indate);
					if($udate<$indate){
						 //$this->redirect(array('createMoneyReceipt'));
						 Yii::app()->user->setFlash('error', Yii::t('smheader', '<p>&#9888 WARNING NOTIFICATION: Money receipt date cannot be earlier than invoice date!!!</p>'));
						 return $this->refresh();
						 
					}
					else
					{
						 if($model->save())
                {	
					
					
                    $connection=Yii::app()->db;
                    foreach( $sm_invnumber as $key => $n ) {
                        $sql = "INSERT INTO sm_invalc (sm_invnumber, sm_number, sm_amount, sm_balanceamt, inserttime, insertuser)
                        VALUES ('$n', '$sm_number', '$sm_amount[$key]', '$sm_balanceamt[$key]', '$inserttime', '$insertuser')";
                        $command=$connection->createCommand($sql);
                        $command->execute();
                    }
                    Yii::app()->user->setFlash('success', Yii::t('smheader', 'Success Message : Data Added Successfully !'));

                }else{
                    Yii::app()->user->setFlash('error', Yii::t('smheader', 'Warning Message: Invalid request !'));
                }
					}
               
                    $this->redirect(array('adminmoneyreceipt'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('smheader', 'Warning Message: Please Allocate Sales Invoice !'));
                $this->redirect(array('createMoneyReceipt', 'cm_code'=>$cm_code, 'cm_name'=>$cm_name, 'sm_branch'=>$sm_branch));
            }
			
		}
		
		$this->render('create_money_receipt',array(
			'model'=>$model, 'mralc'=>$mralc, 'cm_code'=>$cm_code,
            'cm_name'=>$cm_name, 'cname'=>$cname, 'ramt'=>$ramt, 'sm_branch'=>$sm_branch,
		));
	}

    public function actionCancelMoneyReceipt($id, $sm_number){
        $model=new Smheader;

        $sql = "UPDATE sm_header SET sm_stataus = 'Cancel' WHERE id = '$id'";
        $command  = Yii::app()->db->createCommand($sql);
        $command->execute();

        $sql = "DELETE FROM sm_invalc WHERE sm_number = '$sm_number'";
        $command  = Yii::app()->db->createCommand($sql);
        $command->execute();

        Yii::app()->user->setFlash('success', Yii::t('Smheader', 'Canceled Successfully !'));

        $this->redirect(array('manageMoneyReceipt'));

    }

    public function actionApproveMr($id){

        $sql = sprintf("call sp_sm_mrtogl('%s','%s')",
            $id,
            $insertuser = Yii::app()->user->name
        );
        $command  = Yii::app()->db->createCommand($sql);
        $command->execute();

        Yii::app()->user->setFlash('success', Yii::t('Smheader', 'Money Receipt Confirmed Successfully !'));

        $this->redirect(array('manageMoneyReceipt'));

    }
	
	//Delivery Order (Inventory Menu)
	public function actionDeliveryOrder(){
		
		$model=new Smheader('deliveryOrder');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Smheader']))
			$model->attributes=$_GET['Smheader'];

		$this->render('delivery_order',array(
			'model'=>$model,
		));
		
	}
	
	public function actionOrdDeliverd($id){
			    $sql = sprintf("call sp_sm_orddeliverd(%s,'%s')",
                       $id,
                       $insertuser = Yii::app()->user->name
					);
               $command  = Yii::app()->db->createCommand($sql);
			   $command->execute();

            Yii::app()->user->setFlash('success', Yii::t('Deliver', 'Success Message: Delivered Successfully !'));

			 $this->redirect(array('deliveryOrder'));
		}
	
	//search bank / cash 
	public function actionAutocompleteBankCash() {
			
		if (!empty($_GET['term'])) {
		
				$sql = "SELECT am_accountcode as value, am_description as label
		            FROM am_chartofaccounts 
		            WHERE am_accountcode LIKE :qterm OR am_description LIKE :qterm";
				$sql .= ' ORDER BY label ASC';
				$command = Yii::app()->db->createCommand($sql);
				$qterm = '%'.$_GET['term'].'%';
				$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
				$result = $command->queryAll();
				
				echo CJSON::encode($result); exit;
			  } else {
				return false;
			  }
		}
		
		// Post To GL
		public function actionPostToGl(){
		
			$model = new Smheader;
			
			if(isset($_POST['Smheader']))
			{
				$model->attributes=$_POST['Smheader'];
				
				$date = $model->sm_date;
				$branch = $model->sm_territory;
				$insertuser = Yii::app()->user->name;
				
				$sql = sprintf("call sp_sm_dotoar('%s','%s', '%s')",
                       $date,
                       $branch,
                       $insertuser
					);
               $command  = Yii::app()->db->createCommand($sql);
			   $command->execute();

                Yii::app()->user->setFlash('success', Yii::t('Posttogl', 'Success Message: Posted to GL Successfully !'));
			 	$this->redirect(array('postToGl'));
			}
			
			$this->render('post_to_gl',array(
				'model'=>$model,
			));
		}
	
		
		// Money Receipt Post To GL
		public function actionMrPostToGl(){
		
			$model = new Smheader;
			
			if(isset($_POST['Smheader']))
			{
				$model->attributes=$_POST['Smheader'];
				
				$date = $model->sm_date;
				$branch = $model->sm_territory;
				$insertuser = Yii::app()->user->name;
				
				$sql = sprintf("call sp_sm_mrtogl('%s','%s', '%s')",
                       $date,
                       $branch,
                       $insertuser
					);
               $command  = Yii::app()->db->createCommand($sql);
			   $command->execute();

                Yii::app()->user->setFlash('success', Yii::t('Posttogl', 'Success Message: Posted to GL Successfully !'));

			 	$this->redirect(array('mrPostToGl'));
			}
			
			$this->render('mr_post_to_gl',array(
				'model'=>$model,
			));
		}



    public function actionAdminMrAlc($sm_number){
        $model=new Sminvalc('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Sminvalc']))
            $model->attributes=$_GET['Sminvalc'];


        if (Yii::app()->request->isAjaxRequest)
        {
            //outputProcessing = true because including css-files ...
            $this->renderPartial('admin_vwmrrcv',
                array(
                    'model'=>$model, 'sm_number'=>$sm_number,
                ),false,TRUE);
            //js-code to open the dialog
            if (!empty($_GET['asDialog']))
                echo CHtml::script('$("#manage_money_receipt").dialog("open")');
            Yii::app()->end();
        }else{
            $this->render('admin_vwmrrcv',array(
                'model'=>$model, 'sm_number'=>$sm_number,
            ));
        }
    }


    public function actionViewMrAlc($cm_cuscode){
        $model=new Smheader('searchViewMoneyReceipt');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Smheader']))
            $model->attributes=$_GET['Smheader'];


        if (Yii::app()->request->isAjaxRequest)
        {
            //outputProcessing = true because including css-files ...
            $this->renderPartial('view_mr_alc',
                array(
                    'model'=>$model, 'cm_cuscode'=>$cm_cuscode,
                ),false,TRUE);
            //js-code to open the dialog
            if (!empty($_GET['asDialog']))
                echo CHtml::script('$("#money_receipt").dialog("open")');
            Yii::app()->end();
        }else{
            $this->render('view_mr_alc',array(
                'model'=>$model, 'cm_cuscode'=>$cm_cuscode,
            ));
        }
    }


    /*
     * =================================================================================================
     * Direct Sales
     * =================================================================================================
     */

    /*
     * Generate Direct Sale Number
     */

    private function actionDirectSaleNo(){
        $sql="SELECT Fu_GetTrn('Invoice No','DS--',8,0) ";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();

        return $result;
    }

    public function actionDirectSale()
    {
        $model = new Smheader;

        $model->sm_date = date("Y-m-d");
        $model->sm_storeid = Yii::app()->user->employeebranch;

        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        if(isset($_POST['Smheader']))
        {
            $model->attributes=$_POST['Smheader'];
            $model->sm_number = $this->actionDirectSaleNo();
            $model->sm_refe_code = $model->sm_number;

            if($model->save()){
                    Yii::app()->user->setFlash('success', Yii::t('smheader', 'Success Message : Data Added Successfully !'));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('smheader', 'Warning Message: Invalid request !'));
                }
                $this->redirect(array('directSaleAdmin'));
        }

        $this->render('direct_sale',array(
            'model'=>$model,
        ));
    }


    /**
     *
     * Manages Direct Sales models.
     *
     */
    public function actionDirectSaleAdmin()
    {
        $model=new Smheader('directSale');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Smheader']))
            $model->attributes=$_GET['Smheader'];

        $this->render('admin_direct_sale',array(
            'model'=>$model,
        ));
    }


    public function actionApproveDirectSale($id){

        $sql = sprintf("call sp_sm_directsellconfirm('%s','%s')",
            $id,
            $insertuser = Yii::app()->user->name
        );
        $command  = Yii::app()->db->createCommand($sql);
        $command->execute();

        Yii::app()->user->setFlash('success', Yii::t('smHeader', 'Success Message: Direct Sale Confirmed Successfully !'));

        $this->redirect(array('directSaleAdmin'));

    }

    public function actionCancelDirectSale($id){
        $model=new Smheader;

        $sql = "UPDATE sm_header SET sm_stataus = 'Cancel' WHERE id = '$id'";
        $command  = Yii::app()->db->createCommand($sql);
        $command->execute();

        Yii::app()->user->setFlash('success', Yii::t('Smheader', 'Canceled Successfully !'));

        $this->redirect(array('directSaleAdmin'));

    }




}
