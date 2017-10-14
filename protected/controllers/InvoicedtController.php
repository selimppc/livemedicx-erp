<?php

class InvoicedtController extends Controller
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
				'actions'=>array('create','update', 'AutocompleteTestNew'),
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
	public function actionCreate($sm_number, $sm_date, $sm_storeid)
	{
		$model=new Smdetail;

        $model->sm_number = $sm_number;

        $this->performAjaxValidation($model);
        $model->inserttime = date("Y-m-d H:i");
        $model->insertuser = Yii::app()->user->name;

        $searchDetail = $this->actionSearchDetail($sm_number);

        if(isset($_POST['Smdetail']))
        {
            $model->attributes=$_POST['Smdetail'];
            if($model->validate())
            {
                $sm_number = $model->sm_number;
                $cm_code = $model->cm_code;

                $result = $this->actionCheckPoExist($sm_number, $cm_code);

                if($result == 1){
                    Yii::app()->user->setFlash('error', Yii::t('invoiceDt', 'Warning Message: Invoice Number and Product Already Exist !'));
                }else{

                    if($model->save()){
                        Yii::app()->user->setFlash('success', Yii::t('invoiceDt', 'Success Message: Product Added successfully !'));
                    }else{
                        Yii::app()->user->setFlash('error', Yii::t('invoiceDt', 'Invalid Request !'));
                    }

                }

                $this->redirect(array('create', 'sm_number'=>$sm_number,
                    'sm_date'=>$sm_date, 'sm_storeid'=>$sm_storeid,
                ));
            }
        }

		$this->render('create',array(
			'model'=>$model, 'sm_date'=>$sm_date, 'sm_storeid'=>$sm_storeid,
            'searchDetail'=>$searchDetail, 'sm_number'=>$sm_number
		));
	}


    private function actionSearchDetail($sm_number){
        $model=new Smdetail('searchDetail($sm_number)');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Smdetail']))
            $model->attributes=$_GET['Smdetail'];

        return $model;
    }



    private function actionCheckPoExist($sm_number, $cm_code){
        $sql="SELECT 1 FROM sm_detail WHERE sm_number='$sm_number' AND cm_code='$cm_code'";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();
        return $result;
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id, $sm_number)
	{
        $model=$this->loadModel($id);

        $this->performAjaxValidation($model);
        $model->updatetime = date("Y-m-d H:i");
        $model->updateuser = Yii::app()->user->name;

        $productCode = Smdetail::model()->findByPk($id)->cm_code;
        $productName = Productmaster::model()->findByAttributes(array('cm_code' => $productCode))->cm_name;
        $model->product_name = $productName;


        $searchDetail = $this->actionSearchDetail($sm_number);

        $sql = "SELECT sm_date, sm_storeid FROM sm_header WHERE sm_number='$sm_number' ";
        $command = Yii::app()->db->createCommand($sql);
        $result = $command->queryAll();

        $sm_date = $result[0]['sm_date'];
        $sm_storeid = $result[0]['sm_storeid'];

        if(isset($_POST['Smdetail']))
        {
            $model->attributes=$_POST['Smdetail'];
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('Smdetail', 'Success Message: Updated successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('Smdetail', 'Warning Message: Invalid request !'));
            }
            //$this->redirect(array('view','id'=>$model->id));
            $this->redirect(array('create',
                'sm_number'=>$sm_number, 'sm_date'=>$sm_date, 'sm_storeid'=>$sm_storeid
            ));
        }

		$this->render('create',array(
			'model'=>$model, 'sm_date'=>$sm_date, 'sm_storeid'=>$sm_storeid,
            'searchDetail'=>$searchDetail, 'sm_number'=>$sm_number,
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
		$dataProvider=new CActiveDataProvider('Smdetail');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($sm_number)
	{
		$model=new Smdetail('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Smdetail']))
			$model->attributes=$_GET['Smdetail'];

		$this->render('admin',array(
			'model'=>$model, 'sm_number'=>$sm_number,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Smdetail the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Smdetail::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Smdetail $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='smdetail-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


    public function actionAutocompleteTestNew() {

        $date = $_GET['date'];
        $warehouse = $_GET['warehouse'];

        if (!empty($_GET['term'])) {

            $sql = "SELECT t.cm_name as label, t.cm_code as code, t.cm_sellrate as rate,t.cm_selltax as tax, t.cm_stkunit as unit, t.cm_sellunit as sellunit, t.cm_sellconfact as unit_qty, r.cm_code, SUM(available)*t.cm_sellconfact as available
                FROM cm_productmaster t
                INNER JOIN im_vw_stock r ON t.cm_code = r.cm_code
                WHERE r.im_storeid='$warehouse' AND r.im_ExpireDate >='$date' AND (t.cm_name LIKE :qterm OR t.cm_code LIKE :qterm)
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

    }


}
