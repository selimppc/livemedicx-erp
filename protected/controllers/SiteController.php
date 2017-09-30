<?php

class SiteController extends Controller
{

	/**
	 * Declares class-based actions.
	 */
         
     
        public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
                           
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                $model=new UserLogin;
          
                $this->layout = 'home';
                $this->render('application.modules.user.views.user.login', array('model'=>$model));
	}
        
        public function actionAdministration(){
            $this->menu1=array(
                array('label' => Yii::t('app', 'CompanyProfile'), 'url' => array('/companyprofile/admin')),
                array('label' => Yii::t('app', 'Roles'), 'url' => array('/rights')),
				array('label' => Yii::t('app', 'User'), 'url' => array('/user')),
            );
            $this->render('index');
        }

        /**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
                            
		}
		// display the login form
		$this->render('login',array('model'=>$model));
		}

		/**
		 * Logs out the current user and redirect to homepage.
		 */
		public function actionLogout()
		{
			Yii::app()->user->logout();
			$this->redirect(Yii::app()->homeUrl);
		}
		
		public function actionsrList(){
			$this->render('form');
		}
	
	
	
	    //jasPHP Reporting
		public function actionReport()
		{
			//$s = 'Welcome to review reports as well';
			$q = 'SELECT email FROM users where ID = 1';
			$cmd = Yii::app()->db->createCommand($q);
			$result= $cmd -> queryScalar();

			Yii::app()->jasPHP->create(getcwd().'/reports/','report1.jrxml',array('title' => $result,));
			
		}
			
		
		public function actionReportings(){
			$this->render('form');
			
		}
			
		
		public function actionUnderConstruction(){
			$this->render('under_construction');
			
		}
			
		
		
		//Jasper Reports
		public function actionJS()
		{
			$branch = "BURUNDI";
			$fromDate ='2014-04-27';
			$toDate = '2014-05-06';
			
		    $re = new JasperReport('/iTabps/report/imled', 
		    		JasperReport::FORMAT_HTML, array(
            			'pBranch' => $branch,
		    			'pFromDate' => $fromDate,
		    			'pToDate' => $toDate,
		    		)
		    );
		    $re->exec();
		    echo $re->toHTML();
		}	
			
}