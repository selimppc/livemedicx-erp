<?php
 Yii::app()->clientScript->scriptMap=array(
   'jquery.js'=>false,
 );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />


	
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'> 
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/erp/custom-input-fields.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/erp/style.css"/>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/scroll/perfect-scrollbar.css" type="text/css" media="screen"/>
	<script type="text/ecmascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/html5shiv.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/custom-input-fields.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fileuploader/jquery.iframe-transport.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fileuploader/jquery.fileupload.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/scroll/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/scroll/perfect-scrollbar.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/layout.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<style type="text/css">
		body{
		width: 100%;
			background:url('images/bg_home.jpg') no-repeat fixed;
		}
        .myButton {
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #768d87), color-stop(1, #6c7c7c));
            background:-moz-linear-gradient(top, #768d87 5%, #6c7c7c 100%);
            background:-webkit-linear-gradient(top, #768d87 5%, #6c7c7c 100%);
            background:-o-linear-gradient(top, #768d87 5%, #6c7c7c 100%);
            background:-ms-linear-gradient(top, #768d87 5%, #6c7c7c 100%);
            background:linear-gradient(to bottom, #768d87 5%, #6c7c7c 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#768d87', endColorstr='#6c7c7c',GradientType=0);
            background-color:#768d87;
            -moz-border-radius:2px;
            -webkit-border-radius:2px;
            border-radius:2px;
            border:1px solid #aaa;
            display:inline-block;
            cursor:pointer;
            color:blue;
            font-family:arial;
            font-size:14px;
            padding:7px 10px;
            text-decoration:none;
            text-shadow:0px 1px 0px #2b665e;
        }
        .myButton:hover {
            background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #6c7c7c), color-stop(1, #768d87));
            background:-moz-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
            background:-webkit-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
            background:-o-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
            background:-ms-linear-gradient(top, #6c7c7c 5%, #768d87 100%);
            background:linear-gradient(to bottom, #6c7c7c 5%, #768d87 100%);
            filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#6c7c7c', endColorstr='#768d87',GradientType=0);
            background-color:#6c7c7c;
        }
        .myButton:active {
            position:relative;
            top:1px;
        }
	</style>
</head>

<body>
<div id= style="background-image:url(../../../images/login.jpg)">

<div id="main-wrapper">
    <header class="header" id="top-header">
        <div class="logo" id="top-logo">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/erp/logo_say_39x31.png">
			<?php echo CHtml::encode(Yii::app()->name); ?>
			</a>
		</div>
        <div style="margin-top: 1%; text-align: right; margin-right: 7%;">
            <a href="<?php echo Yii::app()->baseUrl; ?>" class="myButton">EN</a>
            <a href="<?php echo Yii::app()->baseUrl; ?>/fr" class="myButton">FR</a>
        </div>
      
    </header>
</div>
    
    
    <div id="homepage_div">
        <div id="homepage_content">
            <div id="homepage_title">
			
                    <img src="<?php  echo Yii::app()->request->baseUrl; ?>/images/welcome.png" />
                
               </div>
            
            <div id="homepage_dashboard">
                <h1> <p style="color:lightblue">Your iTabps ERP innovation....</p></h1>
            </div>
            
            <!-- <div class="homepage_text_div">
                <p class="home_text_gray" style="color: blue; font-size: 20px; ">
                    <b>Think Simple Solution for Complex Connections!!</b> -->
                    <?php /*?><p style="width: 75%; color: #F7F3F3; font-size: 15px; text-align: center;"> <b> operations! </b></p><?php */?>
                </p>
                
                <p>&nbsp;</p>
                
                <p>
                    <img src="<?php  echo Yii::app()->request->baseUrl; ?>/images/home_page_report.png" />
                </p>


            </div>
        </div>
        
        <div id="homepage_login">
            <div id="user_login_div">
                <h2 style="color: white; font-size: 25px; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USER LOGIN</h2>
            </div>
            
            <div>

                <?php echo $content; ?>
            
            </div>
        </div>
    </div>
    
    </div>

<footer class="footer">2012-2016 Copyright &copy; iTabps. All right reserved. </footer>

</body>
</html>