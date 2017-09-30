<?php

class TransferdtController extends Controller
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
				'actions'=>array('index','view', 'TransferNumber', 'AutoComplete', 'GetCmNames'),
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
        /*$this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
        */
        if (Yii::app()->request->isAjaxRequest)
        {
            //outputProcessing = true because including css-files ...
            $this->renderPartial('view',
                array(
                    'model'=>$this->loadModel($id),
                ),false,true);
            //js-code to open the dialog
            if (!empty($_GET['asDialog']))
                echo CHtml::script('$("#stock_receive").dialog("open")');
            Yii::app()->end();
        }
        else
            $this->render('view', array(
                'model'=>$this->loadModel($id),
            ));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($im_transfernum, $branch )
	{
		$model=new Transferdt;

		$model->im_transfernum = $im_transfernum;
		
		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);
			$model->inserttime = date("Y-m-d H:i");
	        $model->insertuser = Yii::app()->user->name;

        $transferdt = $this->actionTransferDtAdmin($im_transfernum);

		if(isset($_POST['Transferdt']))
		{
			$model->attributes=$_POST['Transferdt'];
            if($model->validate())
            {
                $im_transfernum = $model->im_transfernum;
                $cm_code = $model->cm_code;

                $result = $this->actionCheckTrExist($im_transfernum, $cm_code);

                if($result == 1){
                    Yii::app()->user->setFlash('error', Yii::t('transferdt', 'Warning Message: Transfer Number and Product Already Exist!'));
                }else{
                    if($model->save()){
                        Yii::app()->user->setFlash('success', Yii::t('transferdt', 'Success Message : Data Added Successfully !'));
                    }else{
                        Yii::app()->user->setFlash('error', Yii::t('transferdt', 'Warning Message: Invalid request !'));
                    }
                }
                $this->redirect(array('create','im_transfernum'=>$model->im_transfernum, 'branch'=>$branch));
            }
		}

		$this->render('create',array(
			'model'=>$model, 'im_transfernum'=>$im_transfernum,
            'transferdt'=>$transferdt,'branch'=>$branch,
		));
	}

    private function actionCheckTrExist($im_transfernum, $cm_code){
        $sql="SELECT 1 FROM im_transferdt WHERE im_transfernum='$im_transfernum' AND cm_code='$cm_code'";
        $cmd=Yii::app()->db->createCommand($sql);
        $result= $cmd -> queryScalar();
        return $result;
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id, $im_transfernum)
	{
		$model=$this->loadModel($id);

				$model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

        $transferdt = $this->actionTransferDtAdmin($im_transfernum);

        $branch = Transferhd::model()->findByAttributes(array('im_transfernum'=>$im_transfernum))->im_fromstore;

		if(isset($_POST['Transferdt']))
		{
			$model->attributes=$_POST['Transferdt'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('transferdt', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('transferdt', 'Warning Message: Invalid request !'));
            }
				$this->redirect(array('create','im_transfernum'=>$im_transfernum, 'branch'=>$branch));
		}

		$this->render('create',array(
			'model'=>$model, 'im_transfernum'=>$im_transfernum,
            'transferdt'=>$transferdt,'branch'=>$branch,
		));
	}

    private function actionTransferDtAdmin($im_transfernum)
    {
        $model=new Transferdt('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Transferdt']))
            $model->attributes=$_GET['Transferdt'];

        return $model;
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
		$dataProvider=new CActiveDataProvider('Transferdt');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($im_transfernum)
	{
		$model=new Transferdt('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Transferdt']))
			$model->attributes=$_GET['Transferdt'];

        if (Yii::app()->request->isAjaxRequest)
        {
            //outputProcessing = true because including css-files ...
            $this->renderPartial('admin',
                array(
                    'model'=>$model, 'im_transfernum'=>$im_transfernum,
                ),false,TRUE);
            //js-code to open the dialog
            if (!empty($_GET['asDialog']))
                echo CHtml::script('$("#stock_receive").dialog("open")');
            Yii::app()->end();
        }
        else
            $this->render('admin',array(
                'model'=>$model, 'im_transfernum'=>$im_transfernum,
            ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Transferdt the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Transferdt::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Transferdt $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='transferdt-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionTransferNumber( $im_transfernum, $im_status ){
		
		$criteria = new CDbCriteria();
		$criteria -> select = "c.im_status, t.id, t.im_transfernum, t.cm_code, t.im_unit, t.im_quantity, t.im_rate, n.cm_name";
		$criteria -> join = "INNER JOIN im_transferhd c  ON  c.im_transfernum = t.im_transfernum ";
		$criteria -> join .= " INNER JOIN cm_productmaster n ON t.cm_code = n.cm_code";
		$criteria -> condition = "t.im_transfernum = '{$im_transfernum}'";

		$dataProvider = new CActiveDataProvider('Transferdt',array(
            'criteria' => $criteria
        ));
        /*
		$dataProvider = new CActiveDataProvider('Transferdt', array(
		    'criteria'=>array(
		        'condition'=> "t.im_transfernum = '{$im_transfernum}'"  ,
				'select'=> "c.im_status, t.id, t.im_transfernum, t.cm_code, t.im_unit, t.im_quantity, t.im_rate, n.cm_name",
				'join' => "INNER JOIN im_transferhd c  ON  c.im_transfernum = t.im_transfernum ",
				//'join'=> "INNER JOIN cm_productmaster n ON t.cm_code = n.cm_code",
		    ),
		    'pagination'=>array(
		        'pageSize'=>20,
		    ),
		)); */
		
		 $this->render('transfer_number', array('dataProvider' => $dataProvider, 
		 'im_transfernum'=>$im_transfernum, 'im_status'=>$im_status, ));
		}
		
		
		
		function actionGetCmNames() 
		{
          $branch = $_GET['branch'];
          $date = date("Y-m-d");

		  if (!empty($_GET['term'])) {

			$sql = "SELECT t.cm_code as value, t.cm_name as label, t.cm_stkunit as unit, r.cm_code, SUM(r.available) as available
		            FROM cm_productmaster t 
		            INNER JOIN im_vw_stock r ON t.cm_code = r.cm_code
		            WHERE t.cm_name LIKE :qterm AND r.im_storeid='$branch' AND r.im_ExpireDate >='$date'
		            GROUP BY r.cm_code ";

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
