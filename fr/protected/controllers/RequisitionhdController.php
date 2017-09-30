<?php

class RequisitionhdController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
		const STATUS_OPEN = 1;
        const STATUS_CLOSE = 0;
        
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
				'actions'=>array('index','view', 'Reqno'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','delete', 'create','admin', 'PoCreatebyRe'),
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
	
	public function actionReqno(){
		$sql="SELECT Fu_GetTrn('Requisition Number','RE--',8, 0) ";
		$cmd=Yii::app()->db->createCommand($sql);
		$result= $cmd -> queryScalar();
		
		return $result;
	}
	
	public function actionCreate()
	{
		$model=new Requisitionhd;

		$this->performAjaxValidation($model);
			$model->inserttime = date("Y-m-d H:i");
	        $model->insertuser = Yii::app()->user->name;

        $requisitionSearch = new Requisitionhd('search');
        $requisitionSearch->unsetAttributes();  // clear any default values
        if(isset($_GET['Requisitionhd']))
            $requisitionSearch->attributes=$_GET['Requisitionhd'];
			
		if(isset($_POST['Requisitionhd']))
		{
			$model->attributes=$_POST['Requisitionhd'];

            $reqno = $this->actionReqno();
            $model->pp_requisitionno =$reqno;

					if($model->save()){
                        Yii::app()->user->setFlash('success', Yii::t('requisition', 'Success Message : Data Added Successfully !'));
                    }else{
                        Yii::app()->user->setFlash('error', Yii::t('requisition', 'Warning Message: Invalid request !'));
                    }

                    $this->redirect(array('requisitiondt/create', 'pp_requisitionno'=>$model->pp_requisitionno));
		}

		$this->render('create',array(
			'model'=>$model, 'requisitionSearch'=>$requisitionSearch,
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

        $requisitionSearch = new Requisitionhd('search');
        $requisitionSearch->unsetAttributes();  // clear any default values
        if(isset($_GET['Requisitionhd']))
            $requisitionSearch->attributes=$_GET['Requisitionhd'];


		if(isset($_POST['Requisitionhd']))
		{
			$model->attributes=$_POST['Requisitionhd'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('requisition', 'Success Message : Data updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('requisition', 'Warning Message: Invalid request !'));
            }
				$this->redirect(array('create'));
		}

		$this->render('create',array(
			'model'=>$model, 'requisitionSearch'=>$requisitionSearch,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function errorMessage(){
		$errorMsg = 'Error on line';
	    return $errorMsg;
	}

    private function actionRequisionNoExist($pp_requisitionno){
        $model = new Requisitiondt;
        return $model->exists('pp_requisitionno = :pp_requisitionno', array(':pp_requisitionno'=>$pp_requisitionno));

    }

	public function actionDelete($id, $pp_requisitionno)
	{
        // $reqExists = $this->actionRequisionNoExist($pp_requisitionno);

        try{
                $this->loadModel($id)->delete();
                if(!isset($_GET['ajax']))
                    Yii::app()->user->setFlash('success','Success Message: Data - Deleted Successfully');
                else
                    echo "<div class='flash-success'>Success Message: Data - Deleted Successfully</div>";
        }catch(CDbException $e){
            if(!isset($_GET['ajax']))
                Yii::app()->user->setFlash('error','Warning Message: You May Have some Data in Requisition Detail');
            else
                echo "<div class='flash-error'> Warning Message: You May Have some Data in Requisition Detail </div>"; //for ajax

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
		$dataProvider=new CActiveDataProvider('Requisitionhd');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Requisitionhd('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Requisitionhd']))
			$model->attributes=$_GET['Requisitionhd'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Requisitionhd the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Requisitionhd::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Requisitionhd $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='requisitionhd-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
		public function getStatusOptions(){
            return array(
            self::STATUS_OPEN => 'Open',
            self::STATUS_CLOSE => 'Close',
            );
        }
        
        
        
	public function actionPoCreatebyRe($id, $pp_requisitionno){

        $reqExists = $this->actionRequisionNoExist($pp_requisitionno);

        if($reqExists > ""){
                $sql = sprintf("call sp_pp_PoCreatebyRe(%s,'%s')",
                    $id,
                    $insertuser = Yii::app()->user->name
                );
                $command  = Yii::app()->db->createCommand($sql);
                $command->execute();

                Yii::app()->user->setFlash('success', Yii::t('Requisition', 'Success Message: Purchase Order (PO) Created !'));

            }else{
                Yii::app()->user->setFlash('error', Yii::t('Requisition', 'Warning Message: You May have Empty data in Requisition Detail !'));
            }
            $this->redirect(array('admin'));
		}
        

}
