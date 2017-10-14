<?php

class ChartofaccountsController extends Controller
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
				'actions'=>array('create','update', 'admin','delete', 'CallGroupTwo', 'GroupTwo', 'GroupThree'),
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
	public function actionCreate()
	{
		$model=new Chartofaccounts;

        $coa = new Chartofaccounts('searchNew');
        $coa->unsetAttributes();
        if (isset($_GET['Chartofaccounts']))
            $coa->attributes = $_GET['Chartofaccounts'];

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				$model->inserttime = date("Y-m-d H:i");
                $model->insertuser = Yii::app()->user->name;

		if(isset($_POST['Chartofaccounts']))
		{
			$model->attributes=$_POST['Chartofaccounts'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('chartofaccounts', 'Success Message : New Account Added Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('chartofaccounts', 'Warning Message: Account Code Already Exist !'));
            }
				$this->redirect(array('create'));
		}

		$this->render('create',array(
			'model'=>$model, 'coa'=>$coa,
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

        $coa = new Chartofaccounts('searchNew');
        $coa->unsetAttributes();
        if (isset($_GET['Chartofaccounts']))
            $coa->attributes = $_GET['Chartofaccounts'];

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
				$model->updatetime = date("Y-m-d H:i");
                $model->updateuser = Yii::app()->user->name;

		if(isset($_POST['Chartofaccounts']))
		{
			$model->attributes=$_POST['Chartofaccounts'];
			if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('chartofaccounts', 'Success Message : Data Updated Successfully !'));
            }else{
                Yii::app()->user->setFlash('error', Yii::t('chartofaccounts', 'Warning Message: Error !'));
            }
				//$this->redirect(array('view','id'=>$model->am_accountcode));
				$this->redirect(array('create'));
		}

		$this->render('create',array(
			'model'=>$model,  'coa'=>$coa,
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
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Chartofaccounts');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		//$model=new Chartofaccounts('search');
        $model=new Vwchartofacc('search');

		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vwchartofacc']))
			$model->attributes=$_GET['Vwchartofacc'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Chartofaccounts the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Chartofaccounts::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Chartofaccounts $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='chartofaccounts-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	public function actionCallGroupTwo(){
		$groupone = $_POST['am_groupone'];
		//$groupone = "g1";
		
		$criteria = new CDbCriteria();
		$criteria->select = array('am_groupone, am_grouptwo, am_description');
		$criteria->condition = "am_groupone = '$groupone'";
		$criteria->order = 'am_groupone';
		
		$group2 = Grouptwo::model()->findAll($criteria);
		$ary = array();
		
		foreach ($group2 as $i=>$obj){
			$ary [$i]['am_groupone'] = $obj->am_groupone ;
			$ary [$i]['am_grouptwo'] = $obj->am_grouptwo ;
			$ary [$i]['am_description'] = $obj->am_description ;
		}
		
		echo json_encode($ary);
	}
	
 	public function actionGroupTwo() {
 			$am_groupone = $_POST['Chartofaccounts']['am_groupone'];
 				
             $data = Grouptwo::model()->findAll('am_groupone =:am_groupone',
             			array(':am_groupone'=>$am_groupone ));

             $data = CHtml::listData($data,'am_grouptwo','am_description');

             		 echo CHtml::tag('option',
                    	array('value'=>0),CHtml::encode('Choose Group Two'),true);
             
              foreach($data as $value=>$group2)
                {
                    echo CHtml::tag('option',
                               array('value'=>$value),CHtml::encode($group2),true);
                }

        }
	
	public function actionGroupThree() {
 				$am_grouptwo = $_POST['Chartofaccounts']['am_grouptwo'];
 				//$cat_id = $_POST['Productsubsubcategory']['cat_id'];
 				
             $data = Groupthree::model()->findAll('am_grouptwo =:am_grouptwo',
             			array(':am_grouptwo'=>$am_grouptwo ));
			
             $data = CHtml::listData($data,'am_groupthree', 'am_description');
             		 echo CHtml::tag('option',
                     	array('value'=>0),CHtml::encode('Choose Group Three'),true);
                    
              foreach($data as $value=>$group3)
                {
                    echo CHtml::tag('option',
                               array('value'=>$value),CHtml::encode($group3),true);
                }

        }
	
	
}
