<?php
class TransactionController extends Controller
{
	public $layout='//layouts/column2';
        
        const STATUS_YES = 1;
        const STATUS_NO = 0;
        
	
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Transaction');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'CreatePo','CreateGRNnumnber', 'CreateImTrnNum', 'CreateImTrn', 'ManageRequisitionNum', 'ManagePurchaseOrdNum', 'ManageImTrn', 'ManageImTranNum', 'ManageGRNnumnber', 'ViewRequisitionNumber', 'UpdateRequisitionNumber', 'ViewPurchaseOrderNumber', 'UpdatePurchaseOrderNumber', 'ViewGRNNumber' ,'UpdateGRNNumber', 'UpdateIMTransaction', 'CreateInvoiceNo', 'ManageInvoiceNo', 'CreateSalesReturnNo', 'ManageSalesReturnNo', 'CreateMoneyReceiptNo', 'ManageMoneyReceiptNo', 'CreateVoucherNo', 'ManageVoucherNo', 'createCustmerTrnNo', 'manageCustmerTrnNo', 'updateCustmerTrnNo', 'CreateCustomerDistrictCode', 'UpdateCustomerDistrictCode'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','admin','update','delete', 'GlSettings', 'PurchaseSettings', 'UpdateImTrnNum', 'SalesSettings',
                'CreateAdjustmentNumber', 'UpdateAdjustmentNumber',
                ),
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

	public function actionCreate()
	{
        $model=new Transaction;
            
        $model->cm_type = "Requisition Number";
                $model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;


        $requisition = new CActiveDataProvider('Transaction', array(
            'criteria'=>array(
                'condition'=> 't.cm_type = "Requisition Number" ',
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));


	    if(isset($_POST['Transaction']))
	    {
	        $model->attributes = $_POST['Transaction'];
	        if($model->validate())
	        {
                $cm_type = $model->cm_type;
                $cm_trncode = $model->cm_trncode;

                $result = $this->actionCheckTransaction($cm_type, $cm_trncode);

                if($result ==1){
                    Yii::app()->user->setFlash('error', Yii::t('requisition', 'Warning Message:  Type and Code Already Exist!'));
                }else{
                    $this->saveModel($model);
                    Yii::app()->user->setFlash('success', Yii::t('requisition', 'Success Message : Data Added Successfully !'));
                }
				$this->redirect(array('create'));
	        }
	    }
	    $this->render('create',array(
            'model'=>$model, 'requisition'=>$requisition,
        ));
	} 
	
	public function actionDelete($cm_type, $cm_trncode)
	{

        try{
            $this->loadModel($cm_type, $cm_trncode)->delete();

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
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));

	}
	
	public function actionUpdate($cm_type, $cm_trncode)
	{
		$model=$this->loadModel($cm_type, $cm_trncode);

                $model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;


		if(isset($_POST['Transaction']))
		{
			$model->attributes=$_POST['Transaction'];
			if($this->saveModel($model)){
                Yii::app()->user->setFlash('success', Yii::t('transaction', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('transaction', 'Warning Message: Invalid request !'));
            }
			$this->redirect(array('ManageRequisitionNum'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	
	
	//update requisition number
	
	public function actionUpdateRequisitionNumber($cm_type, $cm_trncode)
	{
		$model=$this->loadModel($cm_type, $cm_trncode);

                $model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

        $requisition = new CActiveDataProvider('Transaction', array(
            'criteria'=>array(
                'condition'=> 't.cm_type = "Requisition Number" ',
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));

		if(isset($_POST['Transaction']))
		{
			$model->attributes=$_POST['Transaction'];
            if($model->validate())
            {
                $this->saveModel($model);
                Yii::app()->user->setFlash('success', Yii::t('voucherno', 'Success Message : Requisition No Updated Successfully !'));
            }
			$this->redirect(array('create'));
		}

		$this->render('create',array(
			'model'=>$model, 'requisition'=>$requisition,
		));
	}

    public function actionManageRequisitionNum(){

        $dataProvider = new CActiveDataProvider('Transaction', array(
            'criteria'=>array(
                'condition'=> 't.cm_type = "Requisition Number" ',
                //'params' => array(':pp_purordnum'=>$pp_purordnum)
                //'order'=>'create_time DESC',
                //'with'=>array('author'),
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));

        $this->render('manage_requisition_num', array(
            'dataProvider' => $dataProvider,
        ));

    }
	

	

	
	

	
	
	
	public function actionAdmin()
	{
		$model=new Transaction('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Transaction']))
			$model->attributes=$_GET['Transaction'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	
	public function actionView($cm_type, $cm_trncode)
	{		
		$model=$this->loadModel($cm_type, $cm_trncode);
		$this->render('view',array('model'=>$model, 'cm_type'=>$cm_type, ));
	}
	
	
	
	public function actionViewRequisitionNumber($cm_type, $cm_trncode)
	{		
		$model=$this->loadModel($cm_type, $cm_trncode);
		$this->render('view_requisition_number',array('model'=>$model, 'cm_type'=>$cm_type, ));
	}
	
	public function actionViewGRNNumber($cm_type, $cm_trncode)
	{		
		$model=$this->loadModel($cm_type, $cm_trncode);
		$this->render('view_grn_number',array('model'=>$model, 'cm_type'=>$cm_type, ));
	}
	
	
	public function actionViewPurchaseOrderNumber($cm_type, $cm_trncode)
	{		
		$model=$this->loadModel($cm_type, $cm_trncode);
		$this->render('view_purchase_order_number',array('model'=>$model, 'cm_type'=>$cm_type, ));
	}
	
	
	public function loadModel($cm_type, $cm_trncode)
	{
		$model=Transaction::model()->findByPk(array('cm_type'=>$cm_type, 'cm_trncode'=>$cm_trncode));
		if($model==null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function saveModel($model)
	{
		try
		{
			$model->save();
		}
		catch(Exception $e)
		{
			$this->showError($e);
		}		
	}

	function showError(Exception $e)
	{
		if($e->getCode()==23000)
			$message = "This operation is not permitted due to an existing foreign key reference.";
		else
			$message = "Invalid operation.";
		throw new CHttpException($e->getCode(), $message);
	}		
        
        
        public function getActiveOptions(){
            return array(
            self::STATUS_YES => 'Yes',
            self::STATUS_NO => 'No',
            );
        }
        
        

        
        
        public function actionCreatePo()
		{
		    $model=new Transaction;

            $model->cm_type = "Purchase Order Number";
	                $model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;

            $purchase = new CActiveDataProvider('Transaction', array(
                'criteria'=>array(
                    'condition'=> 't.cm_type = "Purchase Order Number" ',
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

		    if(isset($_POST['Transaction']))
		    {
		        $model->attributes=$_POST['Transaction'];
		        if($model->validate())
		        {
                    $cm_type = $model->cm_type;
                    $cm_trncode = $model->cm_trncode;

                    $result = $this->actionCheckTransaction($cm_type, $cm_trncode);

                    if($result ==1){
                        Yii::app()->user->setFlash('error', Yii::t('purchase', 'Warning Message: Voucher Type and Code Already Exist!'));
                    }else{
                        $this->saveModel($model);
                        Yii::app()->user->setFlash('success', Yii::t('purchase', 'Success Message : Data Added Successfully !'));
                    }

                    $this->redirect(array('createPo'));
		        }
		    }
		    $this->render('purchase_order_number',array(
                'model'=>$model, 'purchase'=>$purchase,
            ));
		}

    //update Purcahse Order number

    public function actionUpdatePurchaseOrderNumber($cm_type, $cm_trncode)
    {
        $model=$this->loadModel($cm_type, $cm_trncode);

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $purchase = new CActiveDataProvider('Transaction', array(
            'criteria'=>array(
                'condition'=> 't.cm_type = "Purchase Order Number" ',
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));

        if(isset($_POST['Transaction']))
        {
            $model->attributes=$_POST['Transaction'];
            if($model->validate())
            {
                $this->saveModel($model);
                Yii::app()->user->setFlash('success', Yii::t('voucherno', 'Success Message : Voucher Updated Successfully !'));
            }
            $this->redirect(array('createPo'));
        }

        $this->render('purchase_order_number',array(
            'model'=>$model, 'purchase'=>$purchase,
        ));
    }

    public function actionManagePurchaseOrdNum(){
			
			$dataProvider = new CActiveDataProvider('Transaction', array(
			    'criteria'=>array(
			        'condition'=> 't.cm_type = "Purchase Order Number" ',
					//'params' => array(':pp_purordnum'=>$pp_purordnum)
			        //'order'=>'create_time DESC',
			        //'with'=>array('author'),
			    ),
			    'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
	
			 $this->render('manage_purchase_order_num', array('dataProvider' => $dataProvider));
			
		}
        
		
	 public function actionCreateGRNnumnber()
		{
		    $model=new Transaction;

            $model->cm_type = "GRN Number";
	                $model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;

            $grnNo = new CActiveDataProvider('Transaction', array(
                'criteria'=>array(
                    'condition'=> 't.cm_type = "GRN Number" ',
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

		    if(isset($_POST['Transaction']))
		    {
		        $model->attributes=$_POST['Transaction'];
		        if($model->validate())
		        {
                    $cm_type = $model->cm_type;
                    $cm_trncode = $model->cm_trncode;

                    $result = $this->actionCheckTransaction($cm_type, $cm_trncode);

                    if($result ==1){
                        Yii::app()->user->setFlash('error', Yii::t('grnno', 'Warning Message: Voucher Type and Code Already Exist!'));
                    }else{
                        $this->saveModel($model);
                        Yii::app()->user->setFlash('success', Yii::t('grnno', 'Success Message : Data Added Successfully !'));
                    }
					$this->redirect(array('createGRNnumnber'));
		        }
		    }
		    $this->render('create_grn_number',array(
                'model'=>$model, 'grnNo'=>$grnNo,
            ));
		}

    //update GRN number

    public function actionUpdateGRNNumber($cm_type, $cm_trncode)
    {
        $model=$this->loadModel($cm_type, $cm_trncode);

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $grnNo = new CActiveDataProvider('Transaction', array(
            'criteria'=>array(
                'condition'=> 't.cm_type = "GRN Number" ',
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));

        if(isset($_POST['Transaction']))
        {
            $model->attributes=$_POST['Transaction'];
            if($model->validate())
            {
                $this->saveModel($model);
                Yii::app()->user->setFlash('success', Yii::t('grnno', 'Success Message : GRN No Updated Successfully !'));
            }

            $this->redirect(array('createGRNnumnber'));
        }

        $this->render('create_grn_number',array(
            'model'=>$model, 'grnNo'=>$grnNo,
        ));
    }
		
	public function actionManageGRNnumnber(){
			
			$dataProvider = new CActiveDataProvider('Transaction', array(
			    'criteria'=>array(
			        'condition'=> 't.cm_type = "GRN Number" ',
					//'params' => array(':pp_purordnum'=>$pp_purordnum)
			        //'order'=>'create_time DESC',
			        //'with'=>array('author'),
			    ),
			    'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
	
			 $this->render('manage_grn_number', array('dataProvider' => $dataProvider));
			
		}
		
		 public function actionCreateImTrnNum()
		{
		    $model=new Transaction;

            $model->cm_type = "IM Transfer Number";
	                $model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;

            $imTrnNum = new CActiveDataProvider('Transaction', array(
                'criteria'=>array(
                    'condition'=> 't.cm_type = "IM Transfer Number" ',

                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
	
		    if(isset($_POST['Transaction']))
		    {
		        $model->attributes=$_POST['Transaction'];
                if($model->validate())
                {
                    $cm_type = $model->cm_type;
                    $cm_trncode = $model->cm_trncode;

                    $result = $this->actionCheckTransaction($cm_type, $cm_trncode);

                    if($result ==1){
                        Yii::app()->user->setFlash('error', Yii::t('imTrnNum', 'Warning Message: Voucher Type and Code Already Exist!'));
                    }else{
                        $this->saveModel($model);
                        Yii::app()->user->setFlash('success', Yii::t('imTrnNum', 'Success Message : Data Added Successfully !'));
                    }

                    $this->redirect(array('createImTrnNum'));
                }
		    }
		    $this->render('create_im_trn_num',array(
                'model'=>$model, 'imTrnNum'=>$imTrnNum,
            ));
		}

        public function actionUpdateImTrnNum($cm_type, $cm_trncode)
        {
            $model=$this->loadModel($cm_type, $cm_trncode);

            $model->updatetime = date("Y-m-d H:i");
            $model->updateuser = Yii::app()->user->name;

            $imTrnNum = new CActiveDataProvider('Transaction', array(
                'criteria'=>array(
                    'condition'=> 't.cm_type = "IM Transfer Number" ',
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

            if(isset($_POST['Transaction']))
            {
                $model->attributes=$_POST['Transaction'];
                if($model->validate())
                {
                    $this->saveModel($model);
                    Yii::app()->user->setFlash('success', Yii::t('voucherno', 'Success Message : Voucher Updated Successfully !'));
                }

                $this->redirect(array('createImTrnNum'));
            }


        $this->render('create_im_trn_num',array(
            'model'=>$model, 'imTrnNum' => $imTrnNum,
        ));
    }

	public function actionManageImTranNum(){
			
			$dataProvider = new CActiveDataProvider('Transaction', array(
			    'criteria'=>array(
			        'condition'=> 't.cm_type = "IM Transfer Number" ',
					//'params' => array(':pp_purordnum'=>$pp_purordnum)
			        //'order'=>'create_time DESC',
			        //'with'=>array('author'),
			    ),
			    'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
	
			 $this->render('manage_im_tran_num', array('dataProvider' => $dataProvider));
			
		}
		
		public function actionCreateImTrn()
		{
		    $model=new Transaction;

            $model->cm_type = "IM Transaction";
	                $model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;

            $imtrn = new CActiveDataProvider('Transaction', array(
                'criteria'=>array(
                    'condition'=> 't.cm_type = "IM Transaction" ',
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
	
		    if(isset($_POST['Transaction']))
		    {
		        $model->attributes=$_POST['Transaction'];
                if($model->validate())
                {
                    $cm_type = $model->cm_type;
                    $cm_trncode = $model->cm_trncode;

                    $result = $this->actionCheckTransaction($cm_type, $cm_trncode);

                    if($result ==1){
                        Yii::app()->user->setFlash('error', Yii::t('voucherno', 'Warning Message: Voucher Type and Code Already Exist!'));
                    }else{
                        $this->saveModel($model);
                        Yii::app()->user->setFlash('success', Yii::t('voucherno', 'Success Message : Data Added Successfully !'));
                    }
                  $this->redirect(array('createImTrn'));
                }
		    }
		    $this->render('create_im_trn',array(
                'model'=>$model, 'imtrn'=>$imtrn,
            ));
		}


        //update IM Transaction

        public function actionUpdateIMTransaction($cm_type, $cm_trncode)
        {
            $model=$this->loadModel($cm_type, $cm_trncode);

            $model->updatetime = date("Y-m-d H:i");
            $model->updateuser = Yii::app()->user->name;

            $imtrn = new CActiveDataProvider('Transaction', array(
                'criteria'=>array(
                    'condition'=> 't.cm_type = "IM Transaction" ',
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

            if(isset($_POST['Transaction']))
            {
                $model->attributes=$_POST['Transaction'];
                if($model->validate())
                {
                    $this->saveModel($model);
                    Yii::app()->user->setFlash('success', Yii::t('voucherno', 'Success Message : Voucher Updated Successfully !'));
                }
                $this->redirect(array('createImTrn'));
            }

            $this->render('create_im_trn',array(
                'model'=>$model, 'imtrn'=>$imtrn,
            ));
        }

		public function actionManageImTrn(){
			
			$dataProvider = new CActiveDataProvider('Transaction', array(
			    'criteria'=>array(
			        'condition'=> 't.cm_type = "IM Transaction" ',
					//'params' => array(':pp_purordnum'=>$pp_purordnum)
			        //'order'=>'create_time DESC',
			        //'with'=>array('author'),
			    ),
			    'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
	
			 $this->render('manage_im_trn', array('dataProvider' => $dataProvider));
			
		}
		
		
		
		/* ========================================================================
		 * 
		 * Create Invoice Number in Setting
		 * 
		 * ========================================================================
		 */
		
		
	public function actionCreateInvoiceNo()
		{
		    $model=new Transaction;

            $model->cm_type ="Invoice No";
	                $model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;

            $invoice = new CActiveDataProvider('Transaction', array(
                'criteria'=>array(
                    'condition'=> 't.cm_type = "Invoice No" ',
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

		    if(isset($_POST['Transaction']))
		    {
		        $model->attributes=$_POST['Transaction'];
		        if($model->validate())
		        {
                    $cm_type = $model->cm_type;
                    $cm_trncode = $model->cm_trncode;

                    $result = $this->actionCheckTransaction($cm_type, $cm_trncode);
                    if($result ==1){
                        Yii::app()->user->setFlash('error', Yii::t('invoice', 'Warning Message: Type and Code Already Exist!'));
                    }else{
                        $this->saveModel($model);
                        Yii::app()->user->setFlash('success', Yii::t('invoice', 'Success Message : Data Added Successfully !'));
                    }
					$this->redirect(array('createInvoiceNo'));
		        }
		    }
		    $this->render('create_invoice_no',array(
                'model'=>$model, 'invoice'=>$invoice,
            ));
		} 
		
		
		public function actionManageInvoiceNo(){
			
			$dataProvider = new CActiveDataProvider('Transaction', array(
			    'criteria'=>array(
			        'condition'=> 't.cm_type = "Invoice No" ',
					//'params' => array(':pp_purordnum'=>$pp_purordnum)
			        //'order'=>'create_time DESC',
			        //'with'=>array('author'),
			    ),
			    'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
	
			 $this->render('manage_invoice_no', array('dataProvider' => $dataProvider));
			
		}
		
		
		public function actionUpdateInvoicerNo($cm_type, $cm_trncode)
			{
				$model=$this->loadModel($cm_type, $cm_trncode);

		                $model->updatetime = date("Y-m-d H:i");
		                $model->updateuser = Yii::app()->user->name;

                $invoice = new CActiveDataProvider('Transaction', array(
                    'criteria'=>array(
                        'condition'=> 't.cm_type = "Invoice No" ',
                    ),
                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));

				if(isset($_POST['Transaction']))
				{
					$model->attributes=$_POST['Transaction'];
                    if($model->validate())
                    {
                        $this->saveModel($model);
                        Yii::app()->user->setFlash('success', Yii::t('voucherno', 'Success Message : Updated Successfully !'));
                    }

					$this->redirect(array('createInvoiceNo'));
				}
		
				$this->render('create_invoice_no',array(
					'model'=>$model, 'invoice'=>$invoice,
				));
			}
		

		/* ========================================================================
		 * 
		 * Sales Number in Setting
		 * 
		 * ========================================================================
		 */
		
		
	public function actionCreateSalesReturnNo()
		{
		    $model=new Transaction;

            $model->cm_type ="Sales Return";
	                $model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;

            $salesReturn = new CActiveDataProvider('Transaction', array(
                'criteria'=>array(
                    'condition'=> 't.cm_type = "Sales Return" ',
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

		    if(isset($_POST['Transaction']))
		    {
		        $model->attributes=$_POST['Transaction'];
                if($model->validate())
                {
                    $cm_type = $model->cm_type;
                    $cm_trncode = $model->cm_trncode;

                    $result = $this->actionCheckTransaction($cm_type, $cm_trncode);

                    if($result ==1){
                        Yii::app()->user->setFlash('error', Yii::t('salesReturn', 'Warning Message: Type and Code Already Exist!'));
                    }else{
                        $this->saveModel($model);
                        Yii::app()->user->setFlash('success', Yii::t('salesReturn', 'Success Message : Data Added Successfully !'));
                    }
                    $this->redirect(array('createSalesReturnNo'));
                }

		    }
		    $this->render('create_sales_return_no',array(
                'model'=>$model, 'salesReturn'=>$salesReturn,
            ));
		} 
		
		
		public function actionManageSalesReturnNo(){
			
			$dataProvider = new CActiveDataProvider('Transaction', array(
			    'criteria'=>array(
			        'condition'=> 't.cm_type = "Sales Return" ',
					//'params' => array(':pp_purordnum'=>$pp_purordnum)
			        //'order'=>'create_time DESC',
			        //'with'=>array('author'),
			    ),
			    'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
	
			 $this->render('manage_sales_return_no', array('dataProvider' => $dataProvider));
			
		}
		
		public function actionUpdateSalesReturnNo($cm_type, $cm_trncode)
			{
				$model=$this->loadModel($cm_type, $cm_trncode);
		                $model->updatetime = date("Y-m-d H:i");
		                $model->updateuser = Yii::app()->user->name;

                $salesReturn = new CActiveDataProvider('Transaction', array(
                    'criteria'=>array(
                        'condition'=> 't.cm_type = "Sales Return" ',
                    ),
                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));

				if(isset($_POST['Transaction']))
				{
					$model->attributes=$_POST['Transaction'];
                    if($model->validate())
                    {
                        $this->saveModel($model);
                        Yii::app()->user->setFlash('success', Yii::t('salesReturn', 'Success Message : Updated Successfully !'));
                    }
					$this->redirect(array('createSalesReturnNo'));
				}
		
				$this->render('create_sales_return_no',array(
					'model'=>$model, 'salesReturn'=>$salesReturn,
				));
			}
		
		
		/* ========================================================================
		 * 
		 * Money Receipt in Setting
		 * 
		 * ========================================================================
		 */
		
		
	public function actionCreateMoneyReceiptNo()
		{
		    $model=new Transaction;

            $model->cm_type ="Money Receipt";
	                $model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;

            $moneyReceipt = new CActiveDataProvider('Transaction', array(
                'criteria'=>array(
                    'condition'=> 't.cm_type = "Money Receipt" ',
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));
	
		    if(isset($_POST['Transaction']))
		    {
		        $model->attributes=$_POST['Transaction'];
                if($model->validate())
                {
                    $cm_type = $model->cm_type;
                    $cm_trncode = $model->cm_trncode;

                    $result = $this->actionCheckTransaction($cm_type, $cm_trncode);

                    if($result ==1){
                        Yii::app()->user->setFlash('error', Yii::t('moneyReceipt', 'Warning Message: Type and Code Already Exist!'));
                    }else{
                        $this->saveModel($model);
                        Yii::app()->user->setFlash('success', Yii::t('moneyReceipt', 'Success Message : Data Added Successfully !'));
                    }
                    $this->redirect(array('createMoneyReceiptNo'));
                }

		    }
		    $this->render('create_money_receipt_no',array(
                'model'=>$model, 'moneyReceipt'=>$moneyReceipt,
            ));
		} 
		
		
		public function actionManageMoneyReceiptNo(){
			
			$dataProvider = new CActiveDataProvider('Transaction', array(
			    'criteria'=>array(
			        'condition'=> 't.cm_type = "Money Receipt" ',
					//'params' => array(':pp_purordnum'=>$pp_purordnum)
			        //'order'=>'create_time DESC',
			        //'with'=>array('author'),
			    ),
			    'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
	
			 $this->render('manage_money_receipt_no', array('dataProvider' => $dataProvider));
			
		}
		

	public function actionUpdateMoneyReceiptNo($cm_type, $cm_trncode)
			{
				$model=$this->loadModel($cm_type, $cm_trncode);

		                $model->updatetime = date("Y-m-d H:i");
		                $model->updateuser = Yii::app()->user->name;

                $moneyReceipt = new CActiveDataProvider('Transaction', array(
                    'criteria'=>array(
                        'condition'=> 't.cm_type = "Money Receipt" ',
                    ),
                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));

				if(isset($_POST['Transaction']))
				{
					$model->attributes=$_POST['Transaction'];
                    if($model->validate())
                    {
                        $this->saveModel($model);
                        Yii::app()->user->setFlash('success', Yii::t('moneyReceipt', 'Success Message : Updated Successfully !'));
                    }
					$this->redirect(array('createMoneyReceiptNo'));
				}
		
				$this->render('create_money_receipt_no',array(
					'model'=>$model, 'moneyReceipt'=>$moneyReceipt,
				));
			}
		
		
		/* ========================================================================
		 * 
		 * Voucher Number
		 * 
		 * ========================================================================
		 */

        private function actionCheckTransaction($cm_type, $cm_trncode){
            $sql="SELECT 1 FROM cm_transaction WHERE cm_type='$cm_type' AND cm_trncode='$cm_trncode'";
            $cmd=Yii::app()->db->createCommand($sql);
            $result= $cmd -> queryScalar();
            return $result;
        }

        private function actionVoucherCmTypeExist($cm_type){
            $model = new Transaction;

            return $model->exists('cm_type = :cm_type', array(':cm_type'=>$cm_type));
        }
        private function actionVoucherCmTrncodeExist($cm_trncode){
            $model = new Transaction;
            return $model->exists('cm_trncode = :cm_trncode', array(':cm_trncode'=>$cm_trncode));
        }

		public function actionCreateVoucherNo()
			{
			    $model=new Transaction;

			    $model->cm_type = "Voucher No";
		                $model->inserttime = date("Y-m-d H:i");
		                $model->insertuser = Yii::app()->user->name;


                $voucherNo = new CActiveDataProvider('Transaction', array(
                    'criteria'=>array(
                        'condition'=> 't.cm_type = "Voucher No" ',
                    ),
                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));


			    if(isset($_POST['Transaction']))
			    {
			        $model->attributes=$_POST['Transaction'];
			        if($model->validate())
			        {
                        $cm_type = $model->cm_type;
                        $cm_trncode = $model->cm_trncode;

                        $result = $this->actionCheckTransaction($cm_type, $cm_trncode);

                        if($result ==1){
                            Yii::app()->user->setFlash('error', Yii::t('voucherno', 'Warning Message: Voucher Type and Code Already Exist!'));
                        }else{
                            $this->saveModel($model);
                            Yii::app()->user->setFlash('success', Yii::t('voucherno', 'Success Message : Data Added Successfully !'));
                        }

						$this->redirect(array('createVoucherNo'));
			        }
			    }
			    $this->render('create_voucher_no',array(
                    'model'=>$model, 'voucherNo' => $voucherNo,
                ));
			} 
			
		
			public function actionManageVoucherNo(){
				
				$dataProvider = new CActiveDataProvider('Transaction', array(
				    'criteria'=>array(
				        'condition'=> 't.cm_type = "Voucher No" ',
				    ),
				    'pagination'=>array(
				        'pageSize'=>10,
				    ),
				));
		
				 $this->render('manage_voucher_no', array('dataProvider' => $dataProvider));
				
			}
			
			
		public function actionUpdateVoucherNo($cm_type, $cm_trncode)
			{
				$model=$this->loadModel($cm_type, $cm_trncode);

		                $model->updatetime = date("Y-m-d H:i");
		                $model->updateuser = Yii::app()->user->name;

                $voucherNo = new CActiveDataProvider('Transaction', array(
                    'criteria'=>array(
                        'condition'=> 't.cm_type = "Voucher No" ',
                    ),
                    'pagination'=>array(
                        'pageSize'=>10,
                    ),
                ));
		
				if(isset($_POST['Transaction']))
				{
					$model->attributes=$_POST['Transaction'];
                    if($model->validate())
                    {
                        $cm_type = $model->cm_type;
                        $cm_trncode = $model->cm_trncode;

                        $voucherCmTypeExist = $this->actionVoucherCmTypeExist($cm_type);
                        $voucherCmTrnExist = $this->actionVoucherCmTrncodeExist($cm_trncode);

                       // if($voucherCmTypeExist >"" && $voucherCmTrnExist>""){
                        //    Yii::app()->user->setFlash('error', Yii::t('voucherno', 'Warning Message: Voucher Type and Code Already Exist!'));
                       // }else{
                            $this->saveModel($model);
                            Yii::app()->user->setFlash('success', Yii::t('voucherno', 'Success Message : Voucher Updated Successfully !'));
                       // }

                        $this->redirect(array('createVoucherNo'));
                    }
				}
		
				$this->render('create_voucher_no',array(
                    'model'=>$model, 'voucherNo' => $voucherNo,
				));
			}
			
			
		//// Cutomer Transaction Number ///////////////////////////////////////////////////////////////////////////
			
 		public function actionCreateCustmerTrnNo()
		{
		    $model=new Transaction;
	            $model->cm_type = "Customer TRN Number";
	                
	                $model->inserttime = date("Y-m-d H:i");
	                $model->insertuser = Yii::app()->user->name;

            $data = new CActiveDataProvider('Transaction', array(
                'criteria'=>array(
                    'condition'=> 't.cm_type = "Customer TRN Number" ',
                    'order'=>'inserttime DESC',
                ),
                'pagination'=>array(
                    'pageSize'=>10,
                ),
            ));

		    if(isset($_POST['Transaction']))
		    {
		        $model->attributes=$_POST['Transaction'];
                if($model->validate())
                {
                    $cm_type = $model->cm_type;
                    $cm_trncode = $model->cm_trncode;

                    $result = $this->actionCheckTransaction($cm_type, $cm_trncode);

                    if($result ==1){
                        Yii::app()->user->setFlash('error', Yii::t('customerTranasction', 'Warning Message: Type and Code Already Exist!'));
                    }else{
                        $this->saveModel($model);
                        Yii::app()->user->setFlash('success', Yii::t('customerTranasction', 'Success Message : Data Added Successfully !'));
                    }
                    $this->redirect(array('createCustmerTrnNo'));
                }
		    }
		    $this->render('create_customer_no',array(
                'model'=>$model, 'data'=>$data,
            ));
		} 
		
		public function actionManageCustmerTrnNo(){
			
			$dataProvider = new CActiveDataProvider('Transaction', array(
			    'criteria'=>array(
			        'condition'=> 't.cm_type = "Customer TRN Number" ',
					//'params' => array(':pp_purordnum'=>$pp_purordnum)
			        //'order'=>'create_time DESC',
			        //'with'=>array('author'),
			    ),
			    'pagination'=>array(
			        'pageSize'=>20,
			    ),
			));
	
			 $this->render('manage_customer_no', array('dataProvider' => $dataProvider));
			
		}
		
		public function actionUpdateCustmerTrnNo($cm_type, $cm_trncode)
			{
				$model=$this->loadModel($cm_type, $cm_trncode);
		
				// Uncomment the following line if AJAX validation is needed
				// $this->performAjaxValidation($model);
				//$model->cm_type = "Requisition Number";
		                $model->updatetime = date("Y-m-d H:i");
		                $model->updateuser = Yii::app()->user->name;
		
				if(isset($_POST['Transaction']))
				{
					$model->attributes=$_POST['Transaction'];
					if($this->saveModel($model)){
                        Yii::app()->user->setFlash('success', Yii::t('transaction', 'Success Message : Data Updated Successfully !'));
                    }else{
                        Yii::app()->user->setFlash('error', Yii::t('transaction', 'Warning Message: Invalid request !'));
                    }
					$this->redirect(array('manageCustmerTrnNo('));
				}
		
				$this->render('update_customer_no',array(
					'model'=>$model,
				));
			}







    //// Customer District Code ///////////////////////////////////////////////////////////////////////////

    public function actionCreateCustomerDistrictCode()
    {
        $model=new Transaction;
        $model->cm_type = "Customer District Code";

        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $data = new CActiveDataProvider('Transaction', array(
            'criteria'=>array(
                'condition'=> 't.cm_type = "Customer District Code" ',
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));

        if(isset($_POST['Transaction']))
        {
            $model->attributes=$_POST['Transaction'];
            if($model->validate())
            {
                $cm_type = $model->cm_type;
                $cm_trncode = $model->cm_trncode;

                $result = $this->actionCheckTransaction($cm_type, $cm_trncode);

                if($result ==1){
                    Yii::app()->user->setFlash('error', Yii::t('customer District', 'Warning Message: Type and Code Already Exist!'));
                }else{
                    $this->saveModel($model);
                    Yii::app()->user->setFlash('success', Yii::t('customer District', 'Success Message : Data Added Successfully !'));
                }
                $this->redirect(array('createCustomerDistrictCode'));
            }
        }
        $this->render('create_customer_district_code',array(
            'model'=>$model, 'data'=>$data,
        ));
    }


    public function actionUpdateCustomerDistrictCode($cm_type, $cm_trncode)
    {
        $model=$this->loadModel($cm_type, $cm_trncode);

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        if(isset($_POST['Transaction']))
        {
            $model->attributes=$_POST['Transaction'];
            if($this->saveModel($model)){
                Yii::app()->user->setFlash('success', Yii::t('transaction', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('transaction', 'Warning Message: Invalid request !'));
            }
            $this->redirect(array('manageCustmerTrnNo('));
        }

        $this->render('update_customer_no',array(
            'model'=>$model,
        ));
    }










		
    /*
     * ================================================================================
     * ::: General Ledger Settings :::
     * ================================================================================
     */

    public function actionGlSettings(){
        $this->pageTitle = 'Settings | General Ledger';

        $this->render('glsettings', array(
            //'model'=>$model,
        ));
    }

    /*
     * ================================================================================
     * ::: Purchase Module Settings :::
     * ================================================================================
     */

    public function actionPurchaseSettings(){
        $this->pageTitle = 'Settings | Purchase Module';

        $this->render('purchase_settings', array(
            //'model'=>$model,
        ));
    }

    /*
     * ================================================================================
     * ::: Sales Module Settings :::
     * ================================================================================
     */

    public function actionSalesSettings(){
        $this->pageTitle = 'Settings | Sales Module';

        $this->render('sales_settings', array(
            //'model'=>$model,
        ));
    }




    /*
     * =====================================================================================
     *
     * IM Adjustment Transaction Number
     *
     * ======================================================================================
     */

    public function actionCreateAdjustmentNumber()
    {
        $model = new Transaction;
        $model->cm_type = "Adjustment Number";

        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $data = new CActiveDataProvider('Transaction', array(
            'criteria'=>array(
                'condition'=> 't.cm_type = "Adjustment Number" ',
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));

        if(isset($_POST['Transaction']))
        {
            $model->attributes=$_POST['Transaction'];
            if($model->validate())
            {
                $cm_type = $model->cm_type;
                $cm_trncode = $model->cm_trncode;

                $result = $this->actionCheckTransaction($cm_type, $cm_trncode);

                if($result ==1){
                    Yii::app()->user->setFlash('error', Yii::t('adjustment', 'Warning Message: Type and Code Already Exist!'));
                }else{
                    $this->saveModel($model);
                    Yii::app()->user->setFlash('success', Yii::t('adjustment', 'Success Message : Data Added Successfully !'));
                }
                $this->redirect(array('createAdjustmentNumber'));
            }
        }
        $this->render('adjustment_transaction_number',array(
            'model'=>$model, 'data'=>$data,
        ));
    }


    public function actionUpdateAdjustmentNumber($cm_type, $cm_trncode)
    {
        $model=$this->loadModel($cm_type, $cm_trncode);

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $data = new CActiveDataProvider('Transaction', array(
            'criteria'=>array(
                'condition'=> 't.cm_type = "Adjustment Number" ',
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));

        if(isset($_POST['Transaction']))
        {
            $model->attributes=$_POST['Transaction'];
            if($this->saveModel($model)){
                Yii::app()->user->setFlash('success', Yii::t('adjustment', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('adjustment', 'Warning Message: Invalid request !'));
            }
            $this->redirect(array('createAdjustmentNumber'));
        }

        $this->render('adjustment_transaction_number',array(
            'model'=>$model, 'data'=>$data,
        ));
    }
}
