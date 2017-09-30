<?php

class RequisitiondtController extends Controller
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
				'actions'=>array('index','view', 'acomplete', 'loadunit', 'ViewRequisition','RequisitionNumber'),
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
	public function actionView($id, $pp_requisitionno)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id), 'pp_requisitionno'=>$pp_requisitionno
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	
	
	public function actionCreate($pp_requisitionno)
	{
		$model=new Requisitiondt;
		$model->pp_requisitionno = $pp_requisitionno;
		
		$this->performAjaxValidation($model);
		$model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;


        $reqDtSearch = new Requisitiondt('search');
        $reqDtSearch->unsetAttributes();  // clear any default values
        if(isset($_GET['Requisitiondt']))
            $reqDtSearch->attributes=$_GET['Requisitiondt'];
		
 
		if(isset($_POST['Requisitiondt']))
		{
			$model->attributes=$_POST['Requisitiondt'];
            if($model->validate())
            {
                $pp_requisitionno = $model->pp_requisitionno;
                $cm_code = $model->cm_code;

                $result = $this->actionCheckReExist($pp_requisitionno, $cm_code);

                if($result == 1){
                    Yii::app()->user->setFlash('error', Yii::t('requisition', 'Warning Message: Requisition and Product Already Exist!'));
                }else{
                    if($model->save()){
                        Yii::app()->user->setFlash('success', Yii::t('requisition', 'Success Message : Data Added Successfully !'));
                    }else{
                        Yii::app()->user->setFlash('error', Yii::t('requisition', 'Warning Message: Invalid request !'));
                    }
                }
                $this->redirect(array('create', 'pp_requisitionno'=>$model->pp_requisitionno));
            }
		}

		$this->render('create',array(
			'model'=>$model, 'pp_requisitionno'=>$pp_requisitionno,
            'reqDtSearch'=>$reqDtSearch,
		));
	}
	
		public function actionCmcode(){
			$sql="SELECT cm_code FROM pp_requisitiondt ORDER BY cm_code DESC LIMIT 5 ";
			$cmd=Yii::app()->db->createCommand($sql);
			$result= $cmd -> queryAll();

			return $result;
		}


    private function actionCheckReExist($pp_requisitionno, $cm_code){
        $sql="SELECT 1 FROM pp_requisitiondt WHERE pp_requisitionno='$pp_requisitionno' AND cm_code='$cm_code'";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();
        return $result;
    }


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id, $pp_requisitionno)
	{
		$model=$this->loadModel($id);

				$model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

        $reqDtSearch = new Requisitiondt('search($pp_requisitionno)');
        $reqDtSearch->unsetAttributes();  // clear any default values
        if(isset($_GET['Requisitiondt']))
            $reqDtSearch->attributes=$_GET['Requisitiondt'];

		if(isset($_POST['Requisitiondt']))
		{
			$model->attributes=$_POST['Requisitiondt'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('requisitiondt', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('requisitiondt', 'Warning Message: Invalid request !'));
            }
				 $this->redirect(array('create','pp_requisitionno'=>$pp_requisitionno));
				
		}

		$this->render('create',array(
            'model'=>$model, 'pp_requisitionno'=>$pp_requisitionno,
            'reqDtSearch'=>$reqDtSearch,
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
		$dataProvider=new CActiveDataProvider('Requisitiondt');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($pp_requisitionno)
	{
		$model=new Requisitiondt('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Requisitiondt']))
			$model->attributes=$_GET['Requisitiondt'];

		$this->render('admin',array(
			'model'=>$model, 'pp_requisitionno'=>$pp_requisitionno,
		));
	}
	
	public function actionDataList(){
		$model=new Requisitiondt;
		
		$this->render('admin',array(
			'model'=>$model, 
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Requisitiondt the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Requisitiondt::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Requisitiondt $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='requisitiondt-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
		public function actionAcomplete(){
		
			if (!empty($_GET['term'])) {
				//$sql = 'SELECT cm_code as id, CONCAT(cm_code," ",cm_name) as value, cm_name as label FROM cm_productmaster WHERE cm_name LIKE :qterm ';
				$sql = 'SELECT cm_code as value, cm_name as label, cm_purunit as unit, ROUND(cm_purconfact) as unitquantity FROM cm_productmaster WHERE cm_name LIKE :qterm ';
				$sql .= ' ORDER BY cm_name ASC';
				$command = Yii::app()->db->createCommand($sql);
				$qterm = $_GET['term'].'%';
				$command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
				$result = $command->queryAll();
				
				echo CJSON::encode($result); exit;
			  } else {
				return false;
			  }
		  

		}
			
			
		public function actionLoadUnit($id) {
				

				//echo $id;
				//exit();
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
		
		
		/**
		 * Displays a particular model.
		 * @param integer $id the ID of the model to be displayed
		 */
		
		public function actionViewRequisition()
		{
			
			$model=new Requisitiondt('searchEmployees');
			//$model->unsetAttributes();  // clear any default values
	
			$this->render('view1',array(
				'model'=>$model,
			));

		}
		
		
		public function actionRequisitionNumber( $pp_requisitionno=NULL ){
		
		//echo $pp_purordnum;
		//exit();
		
		$dataProvider = new CActiveDataProvider('Requisitiondt', array(
		    'criteria'=>array(
				'select' => 't.*, m.cm_name',
		        'condition'=> "t.pp_requisitionno = '{$pp_requisitionno}'"  ,
				'join' => 'INNER JOIN cm_productmaster m ON t.cm_code = m.cm_code',
		        //'order'=>'create_time DESC',
		        //'with'=>array('author'),
		    ),
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		));
		
		 $this->render('requisition_number', array('dataProvider' => $dataProvider, 
		 'pp_requisitionno'=>$pp_requisitionno));
		}
		
		
		
					
}
