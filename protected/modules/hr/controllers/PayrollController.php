<?php
class PayrollController extends Controller
{
	public $layout='//layouts/column2';
	
	 const STATUS_YES = 1;
     const STATUS_NO = 0;
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
				'actions'=>array('admin','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'CreateHrTransaction', 'ManageHrTransaction', 'ManageHrDefault'),
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
	
	public function actionAdmin()
	{
		$this->render('admin');
		
	}

	public function getActiveOptions(){
		return array(
		self::STATUS_YES => 'Yes',
		self::STATUS_NO => 'No',
		);
	}	
	
	
	/* ========================================================================
	 * 
	 * Settings -> HR Transaction
	 * 
	 * ========================================================================
	 */
	
	
	public function actionCreateHrTransaction()
		{
			$model=new Transaction;
			
			$model->cm_type = "HR Transaction";
			 
					$model->inserttime = date("Y-m-d H:i");
					$model->insertuser = Yii::app()->user->name;
	
			if(isset($_POST['Transaction']))
			{
				$model->attributes=$_POST['Transaction'];
				if($model->save())
					$this->redirect(array('ManageHrTransaction'));
			}
					
			
			$this->render('create_hr_transaction',array('model'=>$model));
		} 
		
	
		public function actionManageHrTransaction(){
			
			$dataProvider = new CActiveDataProvider('Transaction', array(
				'criteria'=>array(
					'condition'=> 't.cm_type = "HR Transaction" ',
					//'params' => array(':pp_purordnum'=>$pp_purordnum)
					//'order'=>'create_time DESC',
					//'with'=>array('author'),
				),
				'pagination'=>array(
					'pageSize'=>20,
				),
			));
	
			 $this->render('manage_hr_transaction', array('dataProvider' => $dataProvider));
			
		}
			

			
	/* ========================================================================
	 * 
	 * Settings -> HR Default
	 * 
	 * ========================================================================
	 */
	
	
	public function actionManageHrDefault(){
			
		$dataProvider = new CActiveDataProvider('Hrdefault', array(
			'criteria'=>array(
				//'condition'=> 't.id = "1" ',
				//'params' => array(':pp_purordnum'=>$pp_purordnum)
				//'order'=>'create_time DESC',
				//'with'=>array('author'),
			),
			'pagination'=>array(
				'pageSize'=>20,
			),
		));

		 $this->render('manage_hr_default', array('dataProvider' => $dataProvider));
		
	}
		
			
			
			
			
}