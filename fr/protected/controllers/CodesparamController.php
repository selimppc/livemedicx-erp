<?php
class CodesparamController extends Controller
{
	public $layout='//layouts/column2';
	
	
	const ACTIVE_YES = 1;
    const ACTIVE_NO = 0;
    
    
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Codesparam');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'AjaxUpdate', 'CreateProductClass', 'CreateProductGroup', 'UpdateProductGroup', 'CreateProductCategory', 'CreateSupplierGroup', 'UnitOfMeasurement', 'ViewSm', 'UpdateSm', 'ViewCurrency', 'GetAccountCode', 'GetTaxAccount'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','admin','update','delete', 'CreateCustomerGroup', 'ManageCustomerGroup', 'CreateMarket', 'ManageMarket','MasterSetup', 'updateProductCategory', 'updateUom', 'UpdateCustomerGroup', 'CreateDistrictCode',
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
	    $model=new Codesparam;
	    
	    		$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

	    if(isset($_POST['ajax']) && $_POST['ajax']==='client-account-create-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }

	    if(isset($_POST['Codesparam']))
	    {
	        $model->attributes=$_POST['Codesparam'];
	        if($model->validate())
	        {
				if($this->saveModel($model)){
                    Yii::app()->user->setFlash('success', Yii::t('Codesparam', 'Success Message : Data Created Successfully !'));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('Codesparam', 'Warning Message: Error !'));
                }
				$this->redirect(array('view','cm_type'=>$model->cm_type, 'cm_code'=>$model->cm_code));
	        }
	    }
	    $this->render('create',array('model'=>$model));
	} 
	
	public function actionDelete($cm_type, $cm_code)
	{

        try{
            $this->loadModel($cm_type, $cm_code)->delete();

            if(!isset($_GET['ajax']))
                Yii::app()->user->setFlash('success','Success Message : Data - Deleted Successfully');
            else
                echo "<div class='flash-success'>Success Message : Data - Deleted Successfully</div>";

        }catch(CDbException $e){
            if(!isset($_GET['ajax']))
                Yii::app()->user->setFlash('error','Warning Message: Invalid request  !');
            else
                echo "<div class='flash-error'> Warning Message: Invalid request  ! </div>"; //for ajax
        }


        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));

	}
	
	public function actionUpdate($cm_type, $cm_code)
	{
		$model=$this->loadModel($cm_type, $cm_code);

				$model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

        $data = $this->actionAdminCodes("Product Class");

		if(isset($_POST['Codesparam']))
		{
			$model->attributes=$_POST['Codesparam'];
            if($model->validate())
            {
                $this->saveModel($model);
                Yii::app()->user->setFlash('success', Yii::t('productClass', 'Success Message : Product Class Updated Successfully !'));
            }

			$this->redirect(array('createProductClass'));
		}

		$this->render('create_product_class',array(
			'model'=>$model, 'data'=>$data,
		));
	}

    public function actionUpdateProductGroup($cm_type, $cm_code)
    {
        $model=$this->loadModel($cm_type, $cm_code);

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $data = $this->actionDataProductGroup("Product Category");
        if(isset($_POST['Codesparam']))
        {
            $model->attributes=$_POST['Codesparam'];

            if($model->validate())
            {
                $this->saveModel($model);
                Yii::app()->user->setFlash('success', Yii::t('productGroup', 'Success Message : Product Category Updated Successfully !'));
            }

            $this->redirect(array('createProductGroup'));
        }

        $this->render('create_product_group',array(
            'model'=>$model, 'data'=>$data,
        ));

    }

    public function actionUpdateProductCategory($cm_type, $cm_code)
    {
        $model=$this->loadModel($cm_type, $cm_code);

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $data = $this->actionAdminCodes("Product Group");

        if(isset($_POST['Codesparam']))
        {
            $model->attributes=$_POST['Codesparam'];
            if($model->validate())
            {
                $this->saveModel($model);
                Yii::app()->user->setFlash('success', Yii::t('productCategory', 'Success Message : Product Group Updated Successfully !'));
            }

            $this->redirect(array('createProductCategory'));
        }

        $this->render('create_product_category',array(
            'model'=>$model, 'data'=>$data,
        ));
    }

    public function actionUpdateUom($cm_type, $cm_code)
    {
        $model=$this->loadModel($cm_type, $cm_code);

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $data = $this->actionAdminCodes("Unit Of Measurement");

        if(isset($_POST['Codesparam']))
        {
            $model->attributes=$_POST['Codesparam'];
            if($model->validate())
            {
                $this->saveModel($model);
                Yii::app()->user->setFlash('success', Yii::t('uom', 'Success Message :  Updated Successfully !'));
            }
            $this->redirect(array('unitOfMeasurement'));
        }

        $this->render('create_unit_measurement',array(
            'model'=>$model, 'data'=>$data,
        ));
    }

	
	public function actionUpdateSm($cm_type, $cm_code)
	{
		$model=$this->loadModel($cm_type, $cm_code);

				$model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

        $data = $this->actionDataSupplierGroup("Supplier Group");

		if(isset($_POST['Codesparam']))
		{
			$model->attributes=$_POST['Codesparam'];
            if($model->validate())
            {
                $this->saveModel($model);
                Yii::app()->user->setFlash('success', Yii::t('supplierGroup', 'Success Message : Supplier group Updated Successfully !'));
            }

			$this->redirect(array('createSupplierGroup'));
		}

		$this->render('create_supplier_group',array(
			'model'=>$model, 'data'=>$data,
		));
	}



    public function actionUpdateCustomerGroup($cm_type, $cm_code)
    {
        $model=$this->loadModel($cm_type, $cm_code);

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $data = $this->actionDataCustomerGroup("Customer Group");

        if(isset($_POST['Codesparam']))
        {
            $model->attributes=$_POST['Codesparam'];
            if($model->validate())
            {
                $this->saveModel($model);
                Yii::app()->user->setFlash('success', Yii::t('customerGroup', 'Success Message : Product Class Updated Successfully !'));
            }

            $this->redirect(array('createCustomerGroup'));
        }

        $this->render('create_customer_group',array(
            'model'=>$model, 'data'=>$data,
        ));
    }
	
	
	public function actionUpdateCurrency($cm_type, $cm_code)
		{
		$model=$this->loadModel($cm_type, $cm_code);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				$model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

		if(isset($_POST['Codesparam']))
		{
			$model->attributes=$_POST['Codesparam'];

			if($this->saveModel($model)){
                Yii::app()->user->setFlash('success', Yii::t('Codesparam', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('Codesparam', 'Warning Message: Invalid Request !'));
            }

			$this->redirect(array('viewcurrency',
	                    'cm_type'=>$model->cm_type, 'cm_code'=>$model->cm_code));
		}

		$this->render('updatecurrency',array(
			'model'=>$model,
		));
	}
	
	public function actionAdmin()
	{
		$model=new Codesparam('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Codesparam']))
			$model->attributes=$_GET['Codesparam'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	public function actionView($cm_type, $cm_code)
	{		
		$model=$this->loadModel($cm_type, $cm_code);
		$this->render('view',array('model'=>$model));
	}
	
	public function actionViewSm($cm_type, $cm_code)
	{		
		$model=$this->loadModel($cm_type, $cm_code);
		$this->render('viewsm',array('model'=>$model));
	}
	
	public function actionViewCurrency($cm_type, $cm_code)
	{		
		$model=$this->loadModel($cm_type, $cm_code);
		$this->render('viewcurrency',array('model'=>$model));
	}
	
	
	public function loadModel($cm_type, $cm_code)
	{
		$model=Codesparam::model()->findByPk(array('cm_type'=>$cm_type, 'cm_code'=>$cm_code));
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
            self::ACTIVE_YES => 'Yes',
            self::ACTIVE_NO => 'No',
            );
        }
        
    //==========================================================
    /// Checking Existence
    //===========================================================
    private function actionCheckCodesParam($cm_type, $cm_code){
        $sql="SELECT 1 FROM cm_codesparam WHERE cm_type='$cm_type' AND cm_code='$cm_code'";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();
        return $result;
    }

    private function actionAdminCodes($cm_type){

        $data = new CActiveDataProvider('Codesparam', array(
            'criteria'=>array(
                "condition"=> "t.cm_type = '{$cm_type}' ",
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
        return $data;
    }
    private function actionDataProductGroup($cm_type){

        //n.am_description as return_account, //CHANGE BY AMIT
        $criteria = new CDbCriteria();
        $criteria -> select = "t.*, c.am_description as account_name, m.am_description as stock_account";
        $criteria -> join = "LEFT JOIN am_chartofaccounts c  ON  c.am_accountcode = t.cm_acccode ";
        //$criteria -> join .= " INNER JOIN am_chartofaccounts n ON n.am_accountcode = t.cm_accrtn"; //CHANGE BY AMIT
        $criteria -> join .= " LEFT JOIN am_chartofaccounts m ON m.am_accountcode = t.cm_accdr";
        $criteria -> condition = "t.cm_type = '{$cm_type}'";

        $data = new CActiveDataProvider('Codesparam',array(
            'criteria' => $criteria,
            'pagination'=>array('pageSize'=>10),
        ));

        return $data;
    }
    private function actionDataSupplierGroup($cm_type){

        $criteria = new CDbCriteria();
        $criteria -> select = "t.*, c.am_description as account_name";
        $criteria -> join = "LEFT JOIN am_chartofaccounts c  ON  c.am_accountcode = t.cm_acccode ";
        $criteria -> condition = "t.cm_type = '{$cm_type}'";

        $data = new CActiveDataProvider('Codesparam',array(
            'criteria' => $criteria,
            'pagination'=>array('pageSize'=>10),
        ));

        return $data;
    }

    private function actionDataCustomerGroup($cm_type){

        $criteria = new CDbCriteria();
        $criteria -> select = "t.*, c.am_description as account_name, n.am_description as disc_account, m.am_description as tax_account, p.am_description as revenue_account";
        $criteria -> join = "LEFT JOIN am_chartofaccounts c  ON  c.am_accountcode = t.cm_acccode ";
        $criteria -> join .= " LEFT JOIN am_chartofaccounts n ON n.am_accountcode = t.cm_accdisc";
        $criteria -> join .= " LEFT JOIN am_chartofaccounts m ON m.am_accountcode = t.cm_acctax";
        $criteria -> join .= " LEFT JOIN am_chartofaccounts p ON p.am_accountcode = t.cm_accdr";

        $criteria -> condition = "t.cm_type = '{$cm_type}'";

        $data = new CActiveDataProvider('Codesparam',array(
            'criteria' => $criteria,
            'pagination'=>array('pageSize'=>10),
        ));

        return $data;
    }

    public function actionCreateProductClass()
	{
	    $model=new Codesparam;
	        $model->cm_type ="Product Class";
	    		$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

        $data = $this->actionAdminCodes("Product Class");

	    if(isset($_POST['Codesparam']))
	    {
	        $model->attributes=$_POST['Codesparam'];
	        if($model->validate())
	        {
                $cm_type = $model->cm_type;
                $cm_code = $model->cm_code;

                $result = $this->actionCheckCodesParam($cm_type, $cm_code);

                if($result ==1){
                    Yii::app()->user->setFlash('error', Yii::t('productClass', 'Warning Message: Type and Code Already Exist!'));
                }else{
                    $this->saveModel($model);
                    Yii::app()->user->setFlash('success', Yii::t('productClass', 'Success Message : Data Added Successfully !'));
                }
				$this->redirect(array('createProductClass'));
	        }
	    }
	    $this->render('create_product_class',array(
            'model'=>$model, 'data'=>$data,
        ));
	} 
	
	
	public function actionCreateProductGroup()
	{
	    $model=new Codesparam;

	        $model->cm_type ="Product Category";
	    		$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

        $data = $this->actionDataProductGroup("Product Category");

	    if(isset($_POST['Codesparam']))
	    {
	        $model->attributes=$_POST['Codesparam'];
            if($model->validate())
            {
                $cm_type = $model->cm_type;
                $cm_code = $model->cm_code;

                $result = $this->actionCheckCodesParam($cm_type, $cm_code);

                if($result ==1){
                    Yii::app()->user->setFlash('error', Yii::t('productGroup', 'Warning Message: Type and Code Already Exist!'));
                }else{
                    $this->saveModel($model);
                    Yii::app()->user->setFlash('success', Yii::t('productGroup', 'Success Message : Data Added Successfully !'));
                }
                $this->redirect(array('createproductgroup'));
            }

	    }
	    $this->render('create_product_group',array(
            'model'=>$model, 'data'=>$data,
        ));
	} 
	
	public function actionCreateProductCategory()
	{
	    $model=new Codesparam;
        $model->cm_type ="Product Group";
	    		$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

        $data = $this->actionAdminCodes("Product Group");

	    if(isset($_POST['Codesparam']))
	    {
	        $model->attributes=$_POST['Codesparam'];
            if($model->validate())
            {
                $cm_type = $model->cm_type;
                $cm_code = $model->cm_code;

                $result = $this->actionCheckCodesParam($cm_type, $cm_code);

                if($result ==1){
                    Yii::app()->user->setFlash('error', Yii::t('productCategory', 'Warning Message: Type and Code Already Exist!'));
                }else{
                    $this->saveModel($model);
                    Yii::app()->user->setFlash('success', Yii::t('productCategory', 'Success Message : Data Added Successfully !'));
                }
                $this->redirect(array('createProductCategory'));
            }
	    }
	    $this->render('create_product_category',array(
            'model'=>$model, 'data'=>$data,
        ));
	} 
	
	public function actionCreateSupplierGroup()
	{
	    $model=new Codesparam;
            $model->cm_type ="Supplier Group";
	    		$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

        $data = $this->actionDataSupplierGroup("Supplier Group");

	    if(isset($_POST['Codesparam']))
	    {
	        $model->attributes=$_POST['Codesparam'];
            if($model->validate())
            {
                $cm_type = $model->cm_type;
                $cm_code = $model->cm_code;

                $result = $this->actionCheckCodesParam($cm_type, $cm_code);

                if($result ==1){
                    Yii::app()->user->setFlash('error', Yii::t('supplierGroup', 'Warning Message: Type and Code Already Exist!'));
                }else{
                    $this->saveModel($model);
                    Yii::app()->user->setFlash('success', Yii::t('supplierGroup', 'Success Message : Data Added Successfully !'));
                }
                $this->redirect(array('createsuppliergroup'));
            }

	    }
	    $this->render('create_supplier_group',array(
            'model'=>$model, 'data'=>$data,
        ));
	} 
	
	public function actionGetAccountCode() 
		{
			
		  if (!empty($_GET['term'])) {
			
			$sql = 'SELECT am_accountcode as value, am_description as label FROM  am_chartofaccounts WHERE am_description LIKE :qterm ';

			$command = Yii::app()->db->createCommand($sql);
			$qterm = '%'.$_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
					
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
		  
		}
		
	public function actionGetTaxAccount() 
		{
			
		  if (!empty($_GET['term'])) {
			
			$sql = 'SELECT am_accountcode as value, am_description as label FROM  am_chartofaccounts WHERE am_description LIKE :qterm ';

			$command = Yii::app()->db->createCommand($sql);
			$qterm = '%'.$_GET['term'].'%';
			$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
			$result = $command->queryAll();
					
			echo CJSON::encode($result); exit;
		  } else {
			return false;
		  }
		  
		}
	
	
	public function actionUnitOfMeasurement()
	{
	    $model=new Codesparam;
            $model->cm_type ="Unit Of Measurement";
	    		$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

        $data = $this->actionAdminCodes("Unit Of Measurement");

	    if(isset($_POST['Codesparam']))
	    {
	        $model->attributes=$_POST['Codesparam'];
            if($model->validate())
            {
                $cm_type = $model->cm_type;
                $cm_code = $model->cm_code;

                $result = $this->actionCheckCodesParam($cm_type, $cm_code);

                if($result ==1){
                    Yii::app()->user->setFlash('error', Yii::t('uom', 'Warning Message: Type and Code Already Exist!'));
                }else{
                    $this->saveModel($model);
                    Yii::app()->user->setFlash('success', Yii::t('uom', 'Success Message : Data Added Successfully !'));
                }
                $this->redirect(array('unitOfMeasurement'));
            }
	    }
	    $this->render('create_unit_measurement',array(
            'model'=>$model, 'data'=>$data,
        ));
	} 
	
	
	public function actionCreateBranchCurrency()
	{
	    $model=new Codesparam;
	    
	    		$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

	    if(isset($_POST['ajax']) && $_POST['ajax']==='client-account-create-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }

	    if(isset($_POST['Codesparam']))
	    {
	        $model->attributes=$_POST['Codesparam'];
	        if($model->validate())
	        {
				if($this->saveModel($model)){
                    Yii::app()->user->setFlash('success', Yii::t('Codesparam', 'Success Message : Data Added Successfully !'));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('Codesparam', 'Warning Message: Invalid Request !'));
                }

				$this->redirect(array('viewcurrency','cm_type'=>$model->cm_type, 'cm_code'=>$model->cm_code));
	        }
	    }
	    $this->render('create_branch_currency',array('model'=>$model));
	} 
	
	
	// Customer Group ->> Settings
	/* ========================================================================= */
	
	public function actionCreateCustomerGroup()
	{
	    $model=new Codesparam;
	    		$model->cm_type = "Customer Group";

	    		$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

        $data = $this->actionDataCustomerGroup("Customer Group");

	    if(isset($_POST['Codesparam']))
	    {
	        $model->attributes=$_POST['Codesparam'];
            if($model->validate())
            {
                $cm_type = $model->cm_type;
                $cm_code = $model->cm_code;

                $result = $this->actionCheckCodesParam($cm_type, $cm_code);

                if($result ==1){
                    Yii::app()->user->setFlash('error', Yii::t('customerGroup', 'Warning Message: Type and Code Already Exist!'));
                }else{
                    $this->saveModel($model);
                    Yii::app()->user->setFlash('success', Yii::t('customerGroup', 'Success Message : Data Added Successfully !'));
                }
                $this->redirect(array('createCustomerGroup'));
            }
	    }
	    $this->render('create_customer_group',array(
            'model'=>$model, 'data'=>$data,
        ));
	} 
	
	public function actionManageCustomerGroup(){
		
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="Customer Group"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));

		 $this->render('manage_customer_group', array('dataProvider' => $dataProvider));
		}
	
	// Customer Group ->> Settings >>> Market
	/* ========================================================================= */
	
	public function actionCreateMarket()
	{
	    $model=new Codesparam;
	    		$model->cm_type = "Market";
	    		$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

	    if(isset($_POST['Codesparam']))
	    {
	        $model->attributes=$_POST['Codesparam'];
	        if($model->validate())
	        {
				if($this->saveModel($model)){
                    Yii::app()->user->setFlash('success', Yii::t('Codesparam', 'Success Message : Data Added Successfully !'));
                }else{
                    Yii::app()->user->setFlash('error', Yii::t('Codesparam', 'Warning Message: Invalid Request !'));
                }

				$this->redirect(array('CreateMarket'));
	        }
	    }
	    $this->render('create_market',array('model'=>$model));
	} 
	
	public function actionManageMarket(){
		
		$dataProvider = new CActiveDataProvider('Codesparam', array(
		    'criteria'=>array(
		        'condition'=>'cm_type="Market"',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));

		 $this->render('manage_market', array('dataProvider' => $dataProvider));
		}
	
	
    /*
     * ========================================================================================
     * Master Setup Area
     * ========================================================================================
     */

    public function actionMasterSetup(){
        $this->pageTitle = 'Settings | Master Setup';

        $this->render('master_setup', array(
            //'model'=>$model,
        ));
    }




    /*
     * ==============================================================================
     *
     * Create District Code
     * =============================================================================
     */

    public function actionCreateDistrictCode()
    {
        $model=new Codesparam;
        $model->cm_type ="District Code";
        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $data = $this->actionAdminCodes("District Code");

        if(isset($_POST['Codesparam']))
        {
            $model->attributes=$_POST['Codesparam'];
            if($model->validate())
            {
                $cm_type = $model->cm_type;
                $cm_code = $model->cm_code;

                $result = $this->actionCheckCodesParam($cm_type, $cm_code);

                if($result ==1){
                    Yii::app()->user->setFlash('error', Yii::t('productClass', 'Warning Message: Type and Code Already Exist!'));
                }else{
                    $this->saveModel($model);
                    Yii::app()->user->setFlash('success', Yii::t('productClass', 'Success Message : Data Added Successfully !'));
                }
                $this->redirect(array('createDistrictCode'));
            }
        }
        $this->render('create_district_code',array(
            'model'=>$model, 'data'=>$data,
        ));
    }
}
