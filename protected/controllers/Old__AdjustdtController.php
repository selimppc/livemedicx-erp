<?php

class AdjustdtController extends Controller
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
				'actions'=>array('admin','delete','create','update', 'GetStockNames'),
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($transaction_number, $branch)
	{
		$model=new Adjustdt;

        $model->transaction_number = $transaction_number;
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $adjustDt = $this->actionAdjustDtAdmin($transaction_number);

        $adjStatus = Adjusthd::model()->findByAttributes(array('transaction_number'=>$transaction_number))->adjustment_type;


        if(isset($_POST['Adjustdt']))
        {
            $model->attributes=$_POST['Adjustdt'];
            if($model->validate())
            {
                $transaction_number = $model->transaction_number;
                $product_code = $model->product_code;

                $result = $this->actionCheckTrExist($transaction_number, $product_code);

                if($result == 1){
                    Yii::app()->user->setFlash('error', Yii::t('adjustDt', 'Warning Message: Product Already Exist!'));
                }else{
                    if($model->save()){
                        Yii::app()->user->setFlash('success', Yii::t('adjustDt', 'Success Message : Data Added Successfully !'));
                    }else{
                        Yii::app()->user->setFlash('error', Yii::t('adjustDt', 'Warning Message: Invalid request !'));
                    }
                }
                $this->redirect(array('create','transaction_number'=>$transaction_number, 'branch'=>$branch));

            }
        }

		$this->render('create',array(
			'model'=>$model, 'transaction_number'=>$transaction_number,
            'adjustDt'=>$adjustDt, 'branch'=>$branch, 'adjStatus'=>$adjStatus,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id, $transaction_number)
	{
		$model=$this->loadModel($id);

        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $adjustDt = $this->actionAdjustDtAdmin($transaction_number);

        $branch = Adjusthd::model()->findByAttributes(array('transaction_number'=>$transaction_number))->branch;
        $adjStatus = Adjusthd::model()->findByAttributes(array('transaction_number'=>$transaction_number))->adjustment_type;

        if(isset($_POST['Adjustdt']))
        {
            $model->attributes=$_POST['Adjustdt'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('adjustdt', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('adjustdt', 'Warning Message: Invalid request !'));
            }
            $this->redirect(array('create','transaction_number'=>$transaction_number, 'branch'=>$branch));
            //$this->redirect(Yii::app()->request->requestUri);
        }

		$this->render('create',array(
			'model'=>$model, 'transaction_number'=>$transaction_number,
            'adjustDt'=>$adjustDt, 'branch'=>$branch, 'adjStatus'=>$adjStatus,
		));
	}


    private function actionAdjustDtAdmin($transaction_number)
    {
        $model=new Adjustdt('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Adjustdt']))
            $model->attributes=$_GET['Adjustdt'];

        return $model;
    }

    private function actionCheckTrExist($transaction_number, $product_code){
        $sql="SELECT 1 FROM im_adjustdt WHERE transaction_number='$transaction_number' AND product_code='$product_code'";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();
        return $result;
    }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Adjustdt');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($transaction_number)
	{
		$model=new Adjustdt('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Adjustdt']))
			$model->attributes=$_GET['Adjustdt'];

		$this->render('admin',array(
			'model'=>$model, 'transaction_number'=>$transaction_number,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Adjustdt the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Adjustdt::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Adjustdt $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='adjustdt-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


    /*function actionGetStockNames()
    {
        $branchName = $_GET['branchName'];
        //$date = date("Y-m-d");

        if (!empty($_GET['term'])) {
            $sql = "SELECT cm_code as value, CONCAT(cm_name,' -- ' ,available,' -- ', im_unit) as label, im_BatchNumber as batch, im_ExpireDate as expire, im_unit as unit, im_rate as rate
		            FROM im_vw_stock
		            WHERE im_storeid='$branchName' AND cm_name LIKE :qterm";
            $sql .= ' ORDER BY cm_name ASC';
            $command = Yii::app()->db->createCommand($sql);
            $qterm = $_GET['term'].'%';
            $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
            $result = $command->queryAll();

            echo CJSON::encode($result); exit;
        } else {
            return false;
        }

    }*/

    function actionGetStockNames()
    {
        $branchName = $_GET['branchName'];
        $adjustmentType = $_GET['adjustmentType'];
        //$date = date("Y-m-d");
        if($adjustmentType == 'Negative Adjustment'){
            if (!empty($_GET['term'])) {

                $sql = "SELECT cm_code as value, cm_name as label, cm_stkunit as unit
                        FROM cm_productmaster
                        WHERE cm_name LIKE :qterm";
                $sql .= ' ORDER BY cm_name ASC';
                $command = Yii::app()->db->createCommand($sql);
                $qterm = $_GET['term'] . '%';
                $command->bindParam(":qterm", $qterm, PDO::PARAM_STR);
                $result = $command->queryAll();
                echo CJSON::encode($result); exit;
            } else {
                return false;
            }
        }else{
            if (!empty($_GET['term'])) {
                $sql = "SELECT cm_code as value, CONCAT(cm_name,' -- ' ,available,' -- ', im_unit) as label, im_BatchNumber as batch, im_ExpireDate as expire, im_unit as unit, im_rate as rate
		            FROM im_vw_stock
		            WHERE im_storeid='$branchName' AND cm_name LIKE :qterm";
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

    }
}
