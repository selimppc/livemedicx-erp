<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.


return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'ERP and Supply Chain Management',

	'sourceLanguage' => 'en',
	'language' => 'fr',

        //'defaultController' => 'Companyprofile ',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.modules.user.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',
		'application.modules.right.*',
                //'application.modules.right.models*',
		'application.modules.rights.components.*',
		'ext.JasPHP.*',    
		//'ext.yiiexcel.YiiExcel',
		'ext.YiiJasper.*',
   

	),
	
        
	
	'modules'=>array(
		
		'rights'=>array(
			
		   'superuserName'=>'admin', // Name of the role with super user privileges.
		   'authenticatedName'=>'Authenticated',  // Name of the authenticated user role. 
		   'userIdColumn'=>'id', // Name of the user id column in the database. 
		   'userNameColumn'=>'username',  // Name of the user name column in the database. 
		   'enableBizRule'=>true,  // Whether to enable authorization item business rules. 
		   'enableBizRuleData'=>false,   // Whether to enable data for business rules. 
		   'displayDescription'=>true,  // Whether to use item description instead of name. 
		   'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages. 
		   'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages. 

		   'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested. 
		   'layout'=>'rights.views.layouts.main',  // Layout to use for displaying Rights. 
		   'appLayout'=>'application.views.layouts.main', // Application layout. 
		   'cssFile'=>'rights.css', // Style sheet file to use for Rights. 
		   'install'=>false,  // Whether to enable installer. 
		   'debug'=>false,

		),
		
		'avatar'=>array(
		),
		

        'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		), 
		
		'user'=>array(
			'tableUsers' => 'users',
                        'tableProfiles' => 'profiles',
                        'tableProfileFields' => 'profiles_fields',
                         # encrypting method (php hash function)
                'hash' => 'md5',
                # send activation email
                'sendActivationMail' => true,
                # allow access for non-activated users
                'loginNotActiv' => false,
                # activate user on registration (only sendActivationMail = false)
                'activeAfterRegister' => false,
                # automatically login from registration
                'autoLogin' => true,
                # registration path
                'registrationUrl' => array('/user/registration'),
                # recovery password path
                'recoveryUrl' => array('/user/recovery'),
                # login form path
                'loginUrl' => array('/user/login'),
                # page after login
                'returnUrl' => array('/user/profile'),
                # page after logout
                'returnLogoutUrl' => array('/user/login'),
		),
		
			    
		 'reportico' => array(),
		
		 'hr',
		    
		
	),

	// application components
	'components'=>array(

		'user'=>array(
			'class'=>'RWebUser',
			//'class'=>'RWebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('/user/login'),

		),
		'jasPHP' => array(
            'class' => 'JasPHP',
        ),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
        	//'showScriptName' => false,
        	

			'rules'=>array(
        		// '<controller:Purchaseorddt/<pp_purordnum:\w+>'=>'Purchaseorddt/PurchaseOrderNumberS1',
        		'Purchaseorddt/PurchaseOrderNumberS1/<pp_purordnum:\w+>'=>'Purchaseorddt/PurchaseOrderNumberS1',
        		'Requisitiondt/RequisitionNumber/<pp_requisitionno:\w+>'=>'Requisitiondt/RequisitionNumber',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            
                        
			),
			
		),
		'authManager'=>array(

			//'class'=>'RDbAuthManager',
			//'connectionID'=>'db',
			//'defaultRoles'=>array('Authenticated', 'Guest'),
                    
                    'class' => 'RDbAuthManager',
                    'assignmentTable' => 'authassignment',
                    'itemTable' => 'authitem',
                    'itemChildTable' => 'authitemchild',
                    'rightsTable' => 'rights',
			
		),
            

                
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ur',
			'emulatePrepare' => true,
			//'username' => 'da_admin',
			'username' => 'root',
			//'password' => 'RCwgDlZI',
			'password' => '',
			'charset' => 'utf8',
                        
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
				
			),
		),
		
		
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'me@selimreza.com',
		'languages'=>array('fr'=>'French'),

	),
);