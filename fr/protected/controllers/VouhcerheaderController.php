<?php

class VouhcerheaderController extends Controller
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
				'actions'=>array('admin','delete','create','update', 'FiscalYear', 'GetBranchName','AccountName','OpeningBalance', 'PostUnPost', 'YearEndProcess', 'GetVoucherNumber', 'GetVoucherNo', 'AccountPayableVoucherNo', 'ApInvoice', 'ApPayment', 'ApPaymentVoucher','GetBranchNameAp','GetPaymentCode', 'DynamicPackage', 'DynamicPackage2', 'GetExchagerate', 'CreateInvoice', 'ViewGlTrn', 'JournalTransaction','CustomJournalTransaction', 'CustomJournalTransactionView',
				'JournalVoucher', 'PaymentVoucher', 'ReceiptVoucher', 'ReverseEntry', 'JournalVoucherCreate', 'PaymentVoucherCreate','ReceiptVoucherCreate','ReverseEntryCreate',
                'ManageAcPayment', 'SaveOnRowModel',
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

	
	
	/*
	 * Generate Voucher Number:
	 */
	public function actionVoucherNo(){
		$sql="SELECT Fu_GetTrn('Voucher No','VN--',8,0) ";
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
				$yearA = $year - 0;
				$model->am_year = $yearA;
			}else{
				$model->am_year = $year;
			}

		
		$sql = "SELECT am_offset FROM am_default";
		$command = Yii::app()->db->createCommand($sql);
		$offset = $command->queryScalar();	

				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

		if(isset($_POST['Vouhcerheader']))
		{
			$connection=Yii::app()->db;
			$model->attributes=$_POST['Vouhcerheader'];
						
			if($model->save()){
					if ($_POST['am_accountcode'] != NULL){
						$am_vouchernumber = $model->am_vouchernumber;
						$am_accountcode = $_POST['am_accountcode'];
						$am_currency = $_POST['am_currency'];
						$am_exchagerate = $_POST['am_exchagerate'];
						$am_primeamt = $_POST['am_primeamt'];
						$am_baseamt = $_POST['am_baseamt'];
						$am_note = $_POST['am_note'];
						
						$inserttime = $model->inserttime;
						$insertuser = $model->insertuser;
						
						foreach( $am_accountcode as $key => $n ) {
						  	$sql = "INSERT INTO am_voucherdetail (am_accountcode, am_vouchernumber, am_currency, am_exchagerate, am_primeamt, am_baseamt, am_note, inserttime, insertuser) 
						  	VALUES ('$n', '$am_vouchernumber', '$am_currency[$key]','$am_exchagerate[$key]', '$am_primeamt[$key]', '$am_baseamt[$key]', '$am_note[$key]', '$inserttime', '$insertuser')";
						  	$command=$connection->createCommand($sql);
							$command->execute();
						}

                        Yii::app()->user->setFlash('success', Yii::t('voucher', 'Success Message : Data Added Successfully !'));

						$this->redirect(array('admin'));
				
					}else{
                        Yii::app()->user->setFlash('error', Yii::t('voucher', 'Warning Message: Missing Account Code and Information !'));
					}
			}else {
                Yii::app()->user->setFlash('error', Yii::t('voucher', 'Warning Message: Missing Voucher Header Information !'));
			}
					
		}

		$this->render('create',array('model'=>$model, 'model2'=>$model2, 'offset'=>$offset));
	}

	
	public function actionGetVoucherNo(){
	
		$q = $_POST['voucher_no'];
		    
		$sql="SELECT Fu_GetTrn('Voucher No','$q',8,0) ";
		$cmd=Yii::app()->db->createCommand($sql);
		$result= $cmd -> queryScalar();
		
		echo $result;
		//return $result;
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

		if(isset($_POST['Vouhcerheader']))
		{
			$model->attributes=$_POST['Vouhcerheader'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('voucher', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('voucher', 'Warning Message: Invalid request !'));
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
		$dataProvider=new CActiveDataProvider('Vouhcerheader');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Vouhcerheader('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vouhcerheader']))
			$model->attributes=$_GET['Vouhcerheader'];

		$this->render('admin',array(
			'model'=>$model,
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
	
	
	public function actionFiscalYear(){
		
		$year = date("Y");
		$month = date("m");
		$period = 12 + $month - 0;
		$fiscalyr = $year -0;
		
		echo "Year = ".$year."<br>";
		echo "Current Month = ".$month."<br>";
		echo "Fiscal Period = ".$period."<br>";
		echo "Fiscal Year = ".$fiscalyr."<br>";
		
	}
	
	public function actionGetBranchName() 
		{
			
		  if (!empty($_GET['term'])) {
			
			//$sql = 'SELECT cm_branch as value, cm_description as label FROM cm_branchmaster WHERE cm_branch LIKE :qterm ';
			//$sql .= ' ORDER BY cm_name ASC';
			
			$sql = "SELECT a.cm_branch as value, a.cm_description as label, a.cm_currency, b.cm_currency as currency, b.cm_exchangerate as exchangerate 
		            FROM cm_branchmaster a
		            INNER JOIN cm_branchcurrency b ON a.cm_branch = b.cm_branch && a.cm_currency = b.cm_currency
		            WHERE a.cm_branch LIKE :qterm OR a.cm_description LIKE :qterm 
		            ";
			$command = Yii::app()->db->createCommand($sql);
			$qterm = '%'.$_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
					
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
		  
		}
	
		
	public function actionAccountName() 
		{
			
		  if (!empty($_GET['term'])) {
			$sql = 'SELECT am_accountcode as value, am_description as label FROM am_chartofaccounts WHERE am_accountcode LIKE :qterm  OR  	am_description LIKE :qterm ';

			$command = Yii::app()->db->createCommand($sql);
			$qterm = '%'.$_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
					
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
		  
		}
	
		
		/*
		 * Opening Balance
		 * 
		 */
		
	public function actionOpeningBalance()
		{
			$model=new Vouhcerheader;
	
			
			$year = date("Y");
			$month = date("m");
			$model->am_period = 12 + $month - 0;
			$model->am_year = $year -0;
					
			//$model->am_vouchernumber = $this->actionVoucherNo();		
			$model->am_vouchernumber = "VN14000003";
			// Uncomment the following line if AJAX validation is needed
			// $this->performAjaxValidation($model);
					$model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;
	
			if(isset($_POST['Vouhcerheader']))
			{
				$model->attributes=$_POST['Vouhcerheader'];
				
				$am_vouchernumber = $model->am_vouchernumber;
				
				$am_accountcode = $_POST['am_accountcode'];
				$am_currency = $_POST['am_currency'];
				$am_exchagerate = $_POST['am_exchagerate'];
				$am_primeamt = $_POST['am_primeamt'];
				$am_baseamt = $_POST['am_baseamt'];
				$am_note = $_POST['am_note'];
	
				$inserttime = $model->inserttime;
				$insertuser = $model->insertuser;
				
				
				if($model->save()){
				$connection=Yii::app()->db;
				
					foreach( $am_accountcode as $key => $n ) {
					  	$sql = "INSERT INTO am_voucherdetail (am_accountcode, am_vouchernumber, am_currency, am_exchagerate, am_primeamt, am_baseamt, am_note, inserttime, insertuser) 
					  	VALUES ('$n', '$am_vouchernumber', '$am_currency[$key]','$am_exchagerate[$key]', '$am_primeamt[$key]', '$am_baseamt[$key]', '$am_note[$key]', '$inserttime', '$insertuser')";
					  	$command=$connection->createCommand($sql);
						$command->execute();
					}
                    Yii::app()->user->setFlash('success', Yii::t('voucher', 'Success Message : Data Added Successfully !'));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('voucher', 'Warning Message: Invalid request !'));
                }
					$this->redirect(array('admin'));
			}
	
			$this->render('create_opening_balance',array('model'=>$model,));
		}
	
	
	public function actionPostUnPost(){
		
		$model = new Vouhcerheader;
		
		$year = date("Y");
		$month = date("m");
		$period = 12 + $month - 0;
		if( $period > 12 ){
				$postPeriod = $period - 12;
				$period = $postPeriod;
			}else{
				$period = $period;
			}
		
		if( $period <= 12 ){
				$yearA = $year -0;
				$year = $yearA;
			}else{
				$year = $year;
			}

        if(isset($_POST['Vouhcerheader']))
        {
            $radio = $_POST['radio'];

            if($radio=="date"){
                $pfromdate = $_POST['Vouhcerheader']['start_date'];
                $ptodate = $_POST['Vouhcerheader']['end_date'];

                $sql = sprintf("call sp_gl_postunpost_d('%s','%s','%s','%s')",
                       $pfromdate,
                       $ptodate,
                       $paction = "1",
                       $pUser = Yii::app()->user->name
                    );
                $command  = Yii::app()->db->createCommand($sql);
                $command->execute();

                Yii::app()->user->setFlash('success', Yii::t('postunpost', 'Success Message : Data Posted Successfully !'));
                $this->redirect(array('postUnPost'));

            }else if($radio=="year"){
                $pYear = $_POST['year'];
                $pPeriod = $_POST['period'];

                $sql = sprintf("call sp_gl_postunpost_y('%s','%s','%s','%s')",
                       $pYear,
                       $pPeriod,
                       $paction = "1",
                       $pUser = Yii::app()->user->name
                    );
                $command  = Yii::app()->db->createCommand($sql);
                $command->execute();

                Yii::app()->user->setFlash('success', Yii::t('postunpost', 'Success Message : Data Posted Successfully !'));
                $this->redirect(array('postUnPost'));

            }else{
                Yii::app()->user->setFlash('error', Yii::t('postunpost', 'Warning Message : Invalid Request !'));
                $this->redirect(array('postUnPost'));
            }
        }
		
		$this->render('post_unpost',array('model'=>$model,
		    'period'=>$period, 'year'=>$year,
		));
	}
	
	public function actionGetVoucherNumber(){
		
		if (!empty($_GET['term'])) {
			
			$sql = "SELECT am_vouchernumber as value, CONCAT(am_vouchernumber,'  ',am_referance,'  ',am_date) as label 
		            FROM am_vouhcerheader
		            WHERE am_vouchernumber LIKE :qterm OR am_referance LIKE :qterm
		            ";
			$command = Yii::app()->db->createCommand($sql);
			$qterm = '%'.$_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
					
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
	}
	
	
	
	public function actionYearEndProcess(){
		
		$model = new Vouhcerheader;
		
		$this->render('year_end_process',array('model'=>$model,));
	}
	
	
	
	
	public function actionApInvoice(){

		//$model = new Grnheader;

        $model=new Grnheader('searchInvoice');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Grnheader']))
            $model->attributes=$_GET['Grnheader'];

		$this->render('ap_invoice',array('model'=>$model,));
	}
	
	public function actionCreateInvoice($id){
			    $sql = sprintf("call sp_im_invoice(%s,'%s')",
                       $id,
                       $insertuser = Yii::app()->user->name
					);
               $command  = Yii::app()->db->createCommand($sql);
			   $command->execute();

                Yii::app()->user->setFlash('success', Yii::t('invoice', 'Success Message : Invoice Created Successfully !'));

			 $this->redirect(array('apinvoice'));
		}
	
	
	/* =================================================================================================
	 * 
	 * Account Payable Area
	 * 
	 * =================================================================================================
	 */
	
	
	
	
	public function actionApPayment(){

		
		$model = new Vwapayable('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vwapayable']))
			$model->attributes=$_GET['Vwapayable'];

		$this->render('ap_payment',array(
			'model'=>$model,
		));
		
	}
	
	
	public function actionAccountPayableVoucherNo(){
		$sql = "SELECT Fu_GetTrn('Voucher No','APV-',8,0) ";
		$cmd = Yii::app()->db->createCommand($sql);
		$result = $cmd -> queryScalar();
		
		return $result;
	}
	
	public function actionApPaymentVoucher($suppliercode, $suppliername, $accoutcode, $branch ){

		$model = new Vouhcerheader;
		$model2= new Voucherdetail;
					$model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;
        $model->am_branch = $branch;
		
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
				$yearA = $year - 0;
				$model->am_year = $yearA;
			}else{
				$model->am_year = $year;
			}
		
		$offset = $this->actionOffset();
		
		$debator = Chartofaccounts::model()->findByAttributes(array('am_accountcode'=> $accoutcode))->am_description;

		$unpayinvoice = Vwunpaidinv::model()->findAllByAttributes(array('suppliercode'=>$suppliercode, 'branch'=>$branch));
		
		$sql = "SELECT SUM(amount) as unpamt FROM am_vw_unpaidinv WHERE suppliercode = '{$suppliercode}' AND branch ='{$branch}' ";
		//WHERE sm_sign='-1'
		$command = Yii::app()->db->createCommand($sql);
		$unpamt = $command->queryScalar();
		
		$model->am_vouchernumber = $this->actionAccountPayableVoucherNo();

		
		if(isset($_POST['Vouhcerheader']))
			{
                $model->attributes=$_POST['Vouhcerheader'];

                if(isset($_POST['am_invnumber'])){
                    $am_vouchernumber = $model->am_vouchernumber;
                    $am_date = $model->am_date;
                    $am_year = $model->am_year;
                    $am_period = $model->am_period;
                    $am_branch = $model->am_branch;
                    $am_note = $model->am_note;

                    $am_creditorac = $_POST['Vouhcerheader']['am_creditorac'];

                    $am_primeamt = $_POST['am_primeamt'];
                    $am_currency = $_POST['Vouhcerheader']['am_currency'];
                    $am_exchagerate = $_POST['am_exchagerate'];
                    $am_baseamt = $am_primeamt * $am_exchagerate;

                    $am_debatorac = $accoutcode;
                    $am_subacccode = $suppliercode;

                    $am_invnumber = $_POST['am_invnumber'];
                    $am_amount = $_POST['am_amount'];

                    $inserttime = $model->inserttime;
                    $insertuser = $model->insertuser;


                    if($model->save()){
                        $connection=Yii::app()->db;

                        $sql = "INSERT INTO am_voucherdetail (am_vouchernumber, am_accountcode, am_currency, am_exchagerate, am_primeamt, am_baseamt, inserttime, insertuser)
						  	VALUES ('$am_vouchernumber', '$am_creditorac', '$am_currency','$am_exchagerate', '-$am_primeamt', '-$am_baseamt', '$inserttime', '$insertuser')";
                        $command=$connection->createCommand($sql);
                        $command->execute();

                        $sql = "INSERT INTO am_voucherdetail (am_vouchernumber, am_accountcode, am_subacccode, am_currency, am_exchagerate, am_primeamt, am_baseamt, inserttime, insertuser)
						  	VALUES ('$am_vouchernumber', '$am_debatorac', '$am_subacccode', '$am_currency','$am_exchagerate', '$am_primeamt', '$am_baseamt', '$inserttime', '$insertuser')";
                        $command=$connection->createCommand($sql);
                        $command->execute();

                        if ($am_invnumber != null){
                            foreach( $am_invnumber as $key => $n ) {
                                $sql = "INSERT INTO am_apalc (am_invnumber, am_vouchernumber, am_currency, am_exchagerate, am_primeamt, am_amount, inserttime, insertuser)
						  	VALUES ('$n', '$am_vouchernumber', '$am_currency', '$am_exchagerate', '$am_amount[$key]', '$am_baseamt', '$inserttime', '$insertuser')";
                                $command=$connection->createCommand($sql);
                                $command->execute();
                            }
                        }


                        $sql = sprintf("call sp_am_voucherpost('%s','%s')",
                            $am_vouchernumber,
                            $insertuser = Yii::app()->user->name
                        );
                        $command  = Yii::app()->db->createCommand($sql);
                        $command->execute();



                        Yii::app()->user->setFlash('success', Yii::t('appayment', 'Success Message : Data Added Successfully !'));
                    }else{
                        Yii::app()->user->setFlash('error', Yii::t('appayment', 'Warning Message : Invalid Request !'));
                    }

                    $this->redirect(array('appayment'));

                    }else{
                        Yii::app()->user->setFlash('error', Yii::t('appayment', 'Warning Message : please Allocate the Invoice !'));
                    }



			}

		$this->render('ap_payment_voucher',array(
			'model'=>$model, 'suppliercode'=>$suppliercode, 'accoutcode'=>$accoutcode, 
			'suppliername'=>$suppliername, 'offset'=>$offset, 'debator'=>$debator,
			'unpayinvoice'=>$unpayinvoice, 'unpamt'=>$unpamt, 'model2'=>$model2, 'branch'=>$branch,
		));
		
	}
	
	

	public function actionGetBranchNameAp() 
		{
			
		  if (!empty($_GET['term'])) {  
			
			$sql = "SELECT a.cm_branch as value, CONCAT(a.cm_branch,' - ', a.cm_description) as label, a.cm_currency, b.cm_currency as currency, b.cm_exchangerate as exchangerate 
		            FROM cm_branchmaster a
		            INNER JOIN cm_branchcurrency b ON a.cm_branch = b.cm_branch && a.cm_currency = b.cm_currency
		            WHERE a.cm_branch LIKE :qterm OR a.cm_description LIKE :qterm 
		            ";
			
			$command = Yii::app()->db->createCommand($sql);
			$qterm = '%'.$_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
					
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
		  
		}
		
		
	public function actionGetPaymentCode() 
		{
			
		  if (!empty($_GET['term'])) {
			
			$sql = 'SELECT am_accountcode as value, am_description as label FROM am_chartofaccounts WHERE am_description LIKE :qterm ';
			$sql .= ' ORDER BY am_description ASC';
			
			$command = Yii::app()->db->createCommand($sql);
			$qterm = '%'.$_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
					
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
		  
		}
	
	public function actionDynamicPackage()
	    {
			$am_branch = $_GET['value'];
			$currency = $_GET['currency'];
			
	        $data=Branchcurrency::model()->findAll('cm_branch=:cm_branch', 
	                      array(':cm_branch'=>$am_branch));
	     
	        $data=CHtml::listData($data,'cm_currency','cm_currency');
	        foreach($data as $value=>$cm_currency)
	        {
	            echo CHtml::tag('option',
	                       array('value'=>$value),CHtml::encode($cm_currency),true);
	        }
	    } 

	    
	    public function actionGetExchagerate()
		{
			
			$q = $_POST['store'];

			$sql = "SELECT cm_exchangerate as value FROM cm_branchcurrency WHERE cm_currency= '$q' ";
			$command = Yii::app()->db->createCommand($sql);
		    $result= $command->queryScalar(); 
		    echo $result;
		}

		
		
		//view data by voucher header 
		public function actionViewGlTrn($am_vouchernumber, $am_date, $am_year, $am_period){
			
			$model=new VwGltrn('search($am_vouchernumber)');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['VwGltrn']))
				$model->attributes=$_GET['VwGltrn'];
	
			//total Debit 
			$sql = "SELECT SUM(debit) as debit, SUM(credit) as credit FROM am_vw_gltrn WHERE am_vouchernumber = '{$am_vouchernumber}' ";
			$command = Yii::app()->db->createCommand($sql);
			$debit = $command->queryScalar();
			
			//total credit
			$sql = "SELECT SUM(credit) as credit FROM am_vw_gltrn WHERE am_vouchernumber = '{$am_vouchernumber}' ";
			$command = Yii::app()->db->createCommand($sql);
			$credit = $command->queryScalar();
						
				
			$this->render('view_gl_trn',array(
				'model'=>$model, 'am_vouchernumber'=>$am_vouchernumber,
				'am_date'=>$am_date, 'am_year'=>$am_year, 'am_period'=>$am_period,
				'debit'=>$debit, 'credit'=>$credit,
			));
		}
		
		public function actionJournalTransaction(){
			
			$model = new VwGltrn;

			//Total Data 
			$sql = "SELECT am_vouchernumber, am_referance, am_date, am_year, am_period, am_branch,
					SUM(debit) as debit, SUM(credit) as credit  
					FROM am_vw_gltrn GROUP BY 'am_vouchernumber' ORDER BY 'am_date DESC'";
			$command = Yii::app()->db->createCommand($sql);
			$result = $command->queryAll();

			$this->render('journal_transaction',array(
				'model'=>$model, 'result'=>$result,

			));
		}
		
	   public function actionCustomJournalTransaction(){
			
			$model = new VwGltrn;
			
			if(isset($_POST['VwGltrn']))
			{
				$model->attributes=$_POST['VwGltrn'];
				
				$am_branch = $_POST['VwGltrn']['am_branch'];
				$from_date = $_POST['VwGltrn']['from_date'];
				$to_date = $_POST['VwGltrn']['to_date'];

				$this->redirect(array('customJournalTransactionView', 'am_branch'=>$am_branch, 'from_date'=>$from_date, 'to_date'=>$to_date));
			}
				
			$this->render('_form_custom_journal_transaction',array(
				'model'=>$model, 
			));
		}
		
		public function actionCustomJournalTransactionView($am_branch, $from_date, $to_date){
			
			$model = new VwGltrn;
			
			//Total Data 
			$sql = "SELECT am_vouchernumber, am_referance, am_date, am_year, am_period, am_branch,
					SUM(debit) as debit, SUM(credit) as credit  
					FROM am_vw_gltrn 
					WHERE am_branch='{$am_branch}' AND (am_date BETWEEN '{$from_date}' AND '{$to_date}')
					GROUP BY am_vouchernumber";
			$command = Yii::app()->db->createCommand($sql);
			$result = $command->queryAll();
			
				
			$this->render('custom_journal_transaction',array(
				'model'=>$model, 'result'=>$result, 'from_date'=>$from_date,
				'to_date'=>$to_date, 'am_branch'=>$am_branch,
			));
		}
		
		
		//Journal Voucher 
		public function actionJournalVoucher(){
			
			$model=new Vouhcerheader('searchJournalVoucher');
			
			$model->unsetAttributes();  // clear any default values
			
			if(isset($_GET['Vouhcerheader']))
				$model->attributes=$_GET['Vouhcerheader'];
	
			$this->render('admin_journal_voucher',array(
				'model'=>$model,
			));
		}
		
	public function actionJournalVoucherNo(){
		$sql="SELECT Fu_GetTrn('Voucher No','JV--',8,0) ";
		$cmd=Yii::app()->db->createCommand($sql);
		$result= $cmd -> queryScalar();
		
		//echo $result;
		return $result;
	}
		
	public function actionJournalVoucherCreate()
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
				$yearA = $year - 0;
				$model->am_year = $yearA;
			}else{
				$model->am_year = $year;
			}

		
		$sql = "SELECT am_offset FROM am_default";
		$command = Yii::app()->db->createCommand($sql);
		$offset = $command->queryScalar();	

				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;
                
                $model->am_vouchernumber = $this->actionJournalVoucherNo();
                

	if(isset($_POST['Vouhcerheader']))
		{
			$connection=Yii::app()->db;
			$model->attributes=$_POST['Vouhcerheader'];
						
			if($model->save()){
					if ($_POST['am_accountcode'] != NULL){
						$am_vouchernumber = $model->am_vouchernumber;
						$am_accountcode = $_POST['am_accountcode'];
						$am_currency = $_POST['am_currency'];
						$am_exchagerate = $_POST['am_exchagerate'];
						$am_primeamt = $_POST['am_primeamt'];
						$am_baseamt = $_POST['am_baseamt'];
						$am_note = $_POST['am_note'];
						
						$inserttime = $model->inserttime;
						$insertuser = $model->insertuser;
						
						foreach( $am_accountcode as $key => $n ) {
						  	$sql = "INSERT INTO am_voucherdetail (am_accountcode, am_vouchernumber, am_currency, am_exchagerate, am_primeamt, am_baseamt, am_note, inserttime, insertuser) 
						  	VALUES ('$n', '$am_vouchernumber', '$am_currency[$key]','$am_exchagerate[$key]', '$am_primeamt[$key]', '$am_baseamt[$key]', '$am_note[$key]', '$inserttime', '$insertuser')";
						  	$command=$connection->createCommand($sql);
							$command->execute();
						}

                        Yii::app()->user->setFlash('success', Yii::t('journal', 'Success Message : Data Added Successfully !'));

                        $this->redirect(array('JournalVoucher'));
				
					}else{
                        Yii::app()->user->setFlash('error', Yii::t('journal', 'Missing Account Code and Information !'));
					}
			}else {
                Yii::app()->user->setFlash('error', Yii::t('journal', 'Missing Voucher Header Information !'));
			}
					
		}

		$this->render('create_journal_voucher',array('model'=>$model, 'model2'=>$model2, 'offset'=>$offset));
		}
		
		
		//Payment Voucher 
		public function actionPaymentVoucher(){
			
			$model=new Vouhcerheader('searchPaymentVoucher');
			
			$model->unsetAttributes();  // clear any default values
			
			if(isset($_GET['Vouhcerheader']))
				$model->attributes=$_GET['Vouhcerheader'];
	
			$this->render('admin_payment_voucher',array(
				'model'=>$model,
			));
		}
		
		public function actionPaymentVoucherNo(){
			$sql="SELECT Fu_GetTrn('Voucher No','PAY-',8,0) ";
			$cmd=Yii::app()->db->createCommand($sql);
			$result= $cmd -> queryScalar();
			
			//echo $result;
			return $result;
		}
		
	public function actionPaymentVoucherCreate()
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
				$yearA = $year - 0;
				$model->am_year = $yearA;
			}else{
				$model->am_year = $year;
			}

		
		$sql = "SELECT am_offset FROM am_default";
		$command = Yii::app()->db->createCommand($sql);
		$offset = $command->queryScalar();	

				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;
                
                $model->am_vouchernumber = $this->actionPaymentVoucherNo();
                

		if(isset($_POST['Vouhcerheader']))
		{
			$connection=Yii::app()->db;
			$model->attributes=$_POST['Vouhcerheader'];
						
			if($model->save()){
					if ($_POST['am_accountcode'] != NULL){
						$am_vouchernumber = $model->am_vouchernumber;
						$am_accountcode = $_POST['am_accountcode'];
						$am_currency = $_POST['am_currency'];
						$am_exchagerate = $_POST['am_exchagerate'];
						$am_primeamt = $_POST['am_primeamt'];
						$am_baseamt = $_POST['am_baseamt'];
						$am_note = $_POST['am_note'];
						
						$inserttime = $model->inserttime;
						$insertuser = $model->insertuser;
						
						foreach( $am_accountcode as $key => $n ) {
						  	$sql = "INSERT INTO am_voucherdetail (am_accountcode, am_vouchernumber, am_currency, am_exchagerate, am_primeamt, am_baseamt, am_note, inserttime, insertuser) 
						  	VALUES ('$n', '$am_vouchernumber', '$am_currency[$key]','$am_exchagerate[$key]', '$am_primeamt[$key]', '$am_baseamt[$key]', '$am_note[$key]', '$inserttime', '$insertuser')";
						  	$command=$connection->createCommand($sql);
							$command->execute();
						}

                        Yii::app()->user->setFlash('success', Yii::t('payment', 'Success Message : Data Added Successfully !'));

                        $this->redirect(array('PaymentVoucher'));
				
					}else{
                        Yii::app()->user->setFlash('error', Yii::t('payment', 'Warning Message: Missing Account Code and Information !'));

					}
			}else {
                Yii::app()->user->setFlash('error', Yii::t('payment', 'Warning Message: Missing Voucher Header Information !'));

			}
					
		}

		$this->render('create_payment_voucher',array('model'=>$model, 'model2'=>$model2, 'offset'=>$offset));
		}
		
		
		
		
		//Receipt Voucher 
		public function actionReceiptVoucher(){
			
			$model=new Vouhcerheader('searchReceiptVoucher');
			
			$model->unsetAttributes();  // clear any default values
			
			if(isset($_GET['Vouhcerheader']))
				$model->attributes=$_GET['Vouhcerheader'];
	
			$this->render('admin_receipt_voucher',array(
				'model'=>$model,
			));
		}
		
	public function actionReceiptVoucherNo(){
			$sql="SELECT Fu_GetTrn('Voucher No','RCV-',8,0) ";
			$cmd=Yii::app()->db->createCommand($sql);
			$result= $cmd -> queryScalar();
			
			//echo $result;
			return $result;
		}
		
	public function actionReceiptVoucherCreate()
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
				$yearA = $year - 0;
				$model->am_year = $yearA;
			}else{
				$model->am_year = $year;
			}

		
		$sql = "SELECT am_offset FROM am_default";
		$command = Yii::app()->db->createCommand($sql);
		$offset = $command->queryScalar();	

				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;
                
                $model->am_vouchernumber = $this->actionReceiptVoucherNo();
                

		if(isset($_POST['Vouhcerheader']))
		{
			$connection=Yii::app()->db;
			$model->attributes=$_POST['Vouhcerheader'];
						
			if($model->save()){
					if ($_POST['am_accountcode'] != NULL){
						$am_vouchernumber = $model->am_vouchernumber;
						$am_accountcode = $_POST['am_accountcode'];
						$am_currency = $_POST['am_currency'];
						$am_exchagerate = $_POST['am_exchagerate'];
						$am_primeamt = $_POST['am_primeamt'];
						$am_baseamt = $_POST['am_baseamt'];
						$am_note = $_POST['am_note'];
						
						$inserttime = $model->inserttime;
						$insertuser = $model->insertuser;
						
						foreach( $am_accountcode as $key => $n ) {
						  	$sql = "INSERT INTO am_voucherdetail (am_accountcode, am_vouchernumber, am_currency, am_exchagerate, am_primeamt, am_baseamt, am_note, inserttime, insertuser) 
						  	VALUES ('$n', '$am_vouchernumber', '$am_currency[$key]','$am_exchagerate[$key]', '$am_primeamt[$key]', '$am_baseamt[$key]', '$am_note[$key]', '$inserttime', '$insertuser')";
						  	$command=$connection->createCommand($sql);
							$command->execute();
						}

                        Yii::app()->user->setFlash('success', Yii::t('receipt', 'Success Message : Data Added Successfully !'));

						$this->redirect(array('ReceiptVoucher'));
				
					}else{
                        Yii::app()->user->setFlash('error', Yii::t('receipt', 'Warning Message: Missing Account Code and Information !'));

					}
			}else {
                Yii::app()->user->setFlash('error', Yii::t('receipt', 'Warning Message: Missing Voucher Header Information !'));

			}
					
		}

		$this->render('create_receipt_voucher',array('model'=>$model, 'model2'=>$model2, 'offset'=>$offset));
		}
		
		
		//Reverse Entry 
		public function actionReverseEntry(){
			
			$model=new Vouhcerheader('searchReceiptVoucher');
			
			$model->unsetAttributes();  // clear any default values
			
			if(isset($_GET['Vouhcerheader']))
				$model->attributes=$_GET['Vouhcerheader'];
	
			$this->render('admin_reverse_entry',array(
				'model'=>$model,
			));
		}
		
	public function actionReverseEntryNo(){
			$sql="SELECT Fu_GetTrn('Voucher No','REV-',8,0) ";
			$cmd=Yii::app()->db->createCommand($sql);
			$result= $cmd -> queryScalar();
			
			//echo $result;
			return $result;
		}
		
	public function actionReverseEntryCreate()
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
				$yearA = $year - 0;
				$model->am_year = $yearA;
			}else{
				$model->am_year = $year;
			}

		
		$sql = "SELECT am_offset FROM am_default";
		$command = Yii::app()->db->createCommand($sql);
		$offset = $command->queryScalar();	

				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;
                
                $model->am_vouchernumber = $this->actionReverseEntryNo();
                

		if(isset($_POST['Vouhcerheader']))
		{
			$connection=Yii::app()->db;
			$model->attributes=$_POST['Vouhcerheader'];
						
			if($model->save()){
					if ($_POST['am_accountcode'] != NULL){
						$am_vouchernumber = $model->am_vouchernumber;
						$am_accountcode = $_POST['am_accountcode'];
						$am_currency = $_POST['am_currency'];
						$am_exchagerate = $_POST['am_exchagerate'];
						$am_primeamt = $_POST['am_primeamt'];
						$am_baseamt = $_POST['am_baseamt'];
						$am_note = $_POST['am_note'];
						
						$inserttime = $model->inserttime;
						$insertuser = $model->insertuser;
						
						foreach( $am_accountcode as $key => $n ) {
						  	$sql = "INSERT INTO am_voucherdetail (am_accountcode, am_vouchernumber, am_currency, am_exchagerate, am_primeamt, am_baseamt, am_note, inserttime, insertuser) 
						  	VALUES ('$n', '$am_vouchernumber', '$am_currency[$key]','$am_exchagerate[$key]', '$am_primeamt[$key]', '$am_baseamt[$key]', '$am_note[$key]', '$inserttime', '$insertuser')";
						  	$command=$connection->createCommand($sql);
							$command->execute();
						}

                        Yii::app()->user->setFlash('success', Yii::t('reverse', 'Success Message : Data Added Successfully !'));

						$this->redirect(array('ReceiptVoucher'));
				
					}else{
                        Yii::app()->user->setFlash('error', Yii::t('receipt', 'Warning Message: Missing Account Code and Information !'));

					}
			}else {
                Yii::app()->user->setFlash('error', Yii::t('receipt', 'Warning Message: Missing Voucher Header Information !'));

			}
					
		}

		$this->render('create_reverse_entry',array('model'=>$model, 'model2'=>$model2, 'offset'=>$offset));
		}



    /*
     * =====================================================================================
     *  Account Payable » New Account Payable
     * =====================================================================================
     */
    public function actionManageAcPayment(){


        $model = new Vouhcerheader('searchAcPayment');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Vouhcerheader']))
            $model->attributes=$_GET['Vouhcerheader'];

        $this->render('ac_payment',array(
            'model'=>$model,
        ));

    }





    //// Account Payable » Invoice

    public function actionSaveOnRowModel($id, $im_amount){

        $model=new Grnheader();

        if (Yii::app()->request->isAjaxRequest)
        {
            //outputProcessing = true because including css-files ...
            $this->renderPartial('vat',
                array(
                    'model'=>$model, 'id'=>$id,
                ),false,TRUE);
            //js-code to open the dialog
            if (!empty($_GET['asDialog']))
                echo CHtml::script('$("#vat").dialog("open")');
            Yii::app()->end();
        }
        if(isset($_POST['Grnheader']))
        {
            $connection=Yii::app()->db;
            $model->attributes=$_POST['Grnheader'];

            $im_taxrate = $_POST['Grnheader']['im_taxamt'];
            $im_taxamt = $im_amount * $im_taxrate /100;
            $im_netamt = $im_amount + $im_taxamt;

            $sql = "UPDATE im_grnheader SET im_taxrate='$im_taxrate', im_taxamt='$im_taxamt', im_netamt='$im_netamt' WHERE id='$id' ";
            $command  = Yii::app()->db->createCommand($sql);
            $command->execute();


            Yii::app()->user->setFlash('success', Yii::t('vat', 'Success Message : VAT Added Successfully !'));

            $this->redirect(array('vouhcerheader/apinvoice'));
        }
       // $this->redirect(array('vouhcerheader/apinvoice'));
    }



}
