<?php

class GrndetailController extends Controller
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
				'actions'=>array('index','view', 'GrnData','DynamicData','GrnData1', 'GetProductCode', 'UpdateGrndt', 'GrnDetailAdmin'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','admin','update','delete'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	
	
	public function actionCreate($pp_purordnum, $vGrnNumber)
	{
		$model=new Grndetail;
		$model->im_grnnumber = $vGrnNumber;
		
			$model->inserttime = date("Y-m-d H:i");
        	$model->insertuser = Yii::app()->user->name;

		 $this->performAjaxValidation($model);
		 
		if(isset($_POST['Grndetail']))
		{
			$model->attributes=$_POST['Grndetail'];
            if($model->validate())
            {
                $im_grnnumber = $model->im_grnnumber;
                $cm_code = $model->cm_code;

                $result = $this->actionCheckGrnExist($im_grnnumber, $cm_code);

                if($result ==1){
                    Yii::app()->user->setFlash('error', Yii::t('grndetail', 'Warning Message: GRN and Product Already Exist ! To add this one you need to delete the added product from the GRN Detail List'));
                }else{
                    if($model->save()){
                        Yii::app()->user->setFlash('success', Yii::t('grndetail', 'Success Message : Data Created Successfully !'));
                    }else{
                        Yii::app()->user->setFlash('error', Yii::t('grndetail', 'Warning Message: Invalid request !'));
                    }
                }
            $this->redirect(array('Create', 'pp_purordnum'=>$pp_purordnum, 'vGrnNumber'=>$vGrnNumber, ));
            }
		}
				
		$this->render('create',array('model'=>$model, 'pp_purordnum'=>$pp_purordnum, 'vGrnNumber'=>$vGrnNumber,
			'im_grnnumber'=>$vGrnNumber,
		));
		
	}

    private function actionCheckGrnExist($im_grnnumber, $cm_code){
        $sql="SELECT 1 FROM im_grndetail WHERE im_grnnumber='$im_grnnumber' AND cm_code='$cm_code'";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();
        return $result;
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

		 $this->performAjaxValidation($model);

		if(isset($_POST['Grndetail']))
		{
			$model->attributes=$_POST['Grndetail'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('grndetail', 'Success Message : Data Updated Successfully !'));

            }else{
                Yii::app()->user->setFlash('error', Yii::t('grndetail', 'Warning Message: Invalid request !'));
            }

				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	
	
	public function actionUpdateGrndt($id, $im_grnnumber, $cm_code)
	{
		$model=$this->loadModel($id);

				$model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

		 $this->performAjaxValidation($model);

		if(isset($_POST['Grndetail']))
		{
			$model->attributes=$_POST['Grndetail'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('grndetail', 'Success Message : Data Created Successfully !'));

            }else{
                Yii::app()->user->setFlash('error', Yii::t('grndetail', 'Warning Message: Invalid request !'));
            }

				$this->redirect(array('admin','im_grnnumber'=>$model->im_grnnumber));
		}

		$this->render('update_grndt',array(
			'model'=>$model, 'im_grnnumber'=>$im_grnnumber, 'cm_code'=>$cm_code,
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
		$dataProvider=new CActiveDataProvider('Grndetail');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin($im_grnnumber, $im_purordnum)
	{
		$model=new Grndetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Grndetail']))
			$model->attributes=$_GET['Grndetail'];

		$this->render('admin',array(
			'model'=>$model, 'im_grnnumber'=>$im_grnnumber, 'im_purordnum'=>$im_purordnum,
		));
	}

	
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Grndetail the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Grndetail::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Grndetail $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='grndetail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
		public function actionDynamicData($im_grnnumber)
		{
			echo $im_grnnumber;
			exit();
				//$q = 'SELECT cm_purunit,cm_code AS value FROM cm_productmaster WHERE cm_code LIKE ?';
				
				$q = 'SELECT cm_purunit FROM cm_productmaster WHERE cm_code LIKE ?';
				$cmd = Yii::app()->db->createCommand($q);
				$result = $cmd->query(array('%'.$_GET['id'].'%'));
				$data = array();
					foreach ($result as $row) {
					$data[] = $row;
				}
				
				echo CJSON::encode($data);
				Yii::app()->end();
				
			//echo $id;
			//exit();
			
		}
	 
	
		public function actionGrnData(){
		
		//	$model = new Grndetail;

			$sql = "SELECT t.im_grnnumber, t.im_purordnum, r.cm_code, r.pp_quantity, r.pp_unit, r.pp_unitqty, r.pp_purchasrate, p.cm_description, p.cm_code
		            FROM im_grnheader t 
		            INNER JOIN pp_purchaseorddt r ON t.im_purordnum = r.pp_purordnum
		            INNER JOIN cm_productmaster p ON p.cm_code = r.cm_code
		            ";
		
		        return Yii::app()->db->createCommand($sql)->queryAll();
			
		        print_r($sql) ;
		        exit();
            //$sql = "SELECT im_purordnum, im_grnnumber FROM im_grnheader ORDER BY im_grnnumber DESC LIMIT 1 ";
			//$data = Yii::app()->db
			      //  ->createCommand($sql)
			      //  ->queryAll();
			       // ->queryScalar();
	    		
				//print_r($data);
				//echo CJSON::encode($sql);
				//Yii::app()->end();
				//return $data;
			}
			
			
	
			
			public function GrnData1(){
				
				$sql = Yii::app()->db->createCommand()
					    ->select('t.im_grnnumber, t.im_purordnum, r.pp_purordnum, r.cm_code, r.pp_quantity, r.pp_unit, r.pp_unitqty, r.pp_purchasrate, p.cm_description, p.cm_code')
					    ->from('im_grnheader t')
					    ->join('pp_purchaseorddt r', 't.im_purordnum = r.pp_purordnum')
					    ->join('cm_productmaster p', 'p.cm_code = r.cm_code')
					    //->where('id=:id', array(':id'=>$id))
					    ->order('im_grnnumber DESC')
					    ->queryRow();
					    
					   // print_r($sql);
					    
					    return $sql;
			}
	
			
	public function actionGetProductCode()
		{
		  
			$q = $_POST['store'];
		   	
			$sql = "SELECT cm_name as value FROM cm_productmaster WHERE cm_code= '$q' ";
			$command = Yii::app()->db->createCommand($sql);
		    $result= $command->queryScalar(); 
		    echo $result;
		    
			
		   // $data=Branchmaster::model()->findAll('cm_branch=:store', 
           //       array(':store'=> $_POST['store']));
		    
           //  $data=CHtml::listData($data,'cm_branch','cm_currency');
             
           //   foreach($data as $value=>$cm_currency)  {
           //         echo CHtml::tag
           //          ('option', array('value'=>$value),CHtml::encode($cm_currency),true);
           //       }   
		    
		}
		
		

	/**
	 * Manages all models.
	 */
	public function actionGrnDetailAdmin($im_grnnumber, $im_purordnum, $im_date, $cm_orgname)
	{
		$model=new VwGrndetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['VwGrndetail']))
			$model->attributes=$_GET['VwGrndetail'];

		$this->render('grn_detail_admin',array(
			'model'=>$model, 'im_grnnumber'=>$im_grnnumber,
			'im_purordnum'=>$im_purordnum, 'im_date'=>$im_date, 'cm_orgname'=>$cm_orgname,
		));
	}
	
}
