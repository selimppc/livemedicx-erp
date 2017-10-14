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
</head>

<body>


<div id="main-wrapper">
    <header class="header" id="top-header">
        <div class="logo" id="top-logo">
			<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/site/administration">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/erp/logo_say_39x31.png">
			<?php echo CHtml::encode(Yii::app()->name); ?>
			</a>
		</div>
        
        <nav class="navigation" id="header-navigation">
            <ul id="top-navigation-items" class="navigaation-list">
                <?php if (Yii::app()->user->getId() !== null){ ?>
                <li><a href="#"><i id="icon_30x30_1" class="top_nav_icons">&nbsp;</i></a></li>
                <li><a href="#"><i id="icon_30x30_2" class="top_nav_icons">&nbsp;</i></a></li>
                <li><a href="#"><i id="icon_30x30_3" class="top_nav_icons">&nbsp;</i></a></li>
                <li><a href="#"><i id="icon_30x30_4" class="top_nav_icons">&nbsp;</i></a></li>
                <li class="last_item"><a href="#"><i id="icon_30x30_5" class="top_nav_icons">&nbsp;</i></a></li>
                <?php  } else { ?>
                <li class="last_item"><a href="#"><i id="icon_30x30_5" class="top_nav_icons">&nbsp;</i></a></li>
                <?php } ?>
            </ul>
        </nav>
                
       
    </header>
    
    
<header class="header" id="sub-header">
    <div class="active-btn-holder"><div id="icon_30x30_6" class="active-btn-icon"> <b style="color: #4C9CCF; padding-left: 30px; font-size: 16px;">&nbsp; </b></div></div>
    <nav class="breadcrumb-holder">

        <?php if (isset($this->breadcrumbs)): ?>
            <?php
            $this->widget('zii.widgets.CBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'homeLink'=>false // add this line
            ));
            ?><!-- breadcrumbs -->
<?php endif ?>

    </nav>
    <div class="options-holder">
        <a href="#"><i class="option-icons">&nbsp;</i></a>
    </div>
</header>


<section id="optimized-veiw" class="main">
    <aside class="primary-navigation-holder">
        <div class="primary-nav-scroller">
            <div class="primary-navigation-item-list">
              
                <?php // $this->widget('zii.widgets.CMenu', array(
                //'items' => $this->menu1,
                //'encodeLabel' => false,
                //'htmlOptions' => array(
                  //  'class' => 'page-sidebar-menu hidden-phone hidden-tablet' //You can customize this for your application
                //)
                //));?>
                
 
<?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
    'panels'=>array(
    	'Administration'=> CHtml::link('Company Profile', array('/companyprofile/1'))."<br/>". 
						   CHtml::link('Roles', array('/rights'))."<br />".
						   CHtml::link('User', array('/user'))."<br />".
						   CHtml::link('Reports', array('/reportico/mode/reportings')),
        'Master Setup'=> CHtml::link('Product Master', array('/productmaster/admin'))."<br />".
						   CHtml::link('Supplier Master', array('/suppliermaster/admin'))."<br />".
						   CHtml::link('Branch Master', array('/branchmaster/admin')) ,
		//'Codes & Parameter'=> CHtml::link('Codes Param', array('/codesparam/admin')) ,
		'Purchase'=> CHtml::link('Requisition Entry', array('/requisitionhd/admin'))."<br />".
						   CHtml::link('Purchase Order Entry', array('/purchaseordhd/admin')) ,
						   
		'Inventory'=> CHtml::link('GRN ', array('/purchaseordhd/ViewPurchaseOrderHd'))."<br />".
					  CHtml::link('Recieve Stock', array('/imtransaction/admin')) ."<br />".
					  CHtml::link('Stock View', array('/VwStock/admin')) ."<br />".
					  CHtml::link('Stock Transfer', array('/transferhd/admin')) 
					 // CHtml::link('Report', array('/purchaseordhd/admin')) ,
					 
    ),
    // additional javascript options for the accordion plugin
    'options'=>array(
        //'animated'=>'bounceslide',
    	'collapsible'=> true,
    	'active'=>9,
    	'autoHeight'=>true,
        //'style'=>array('minHeight'=>'100'),
    ),

)); ?>
                
                
                <?php $this->widget('zii.widgets.CMenu', array(
                'items' => array(
                    //array('label' => 'Administration', 'url' => array('/site/administration'),'authItem'=>'home'),
                    //array('label' => Yii::t('app', 'About'), 'url' => array('/site/page', 'view' => 'about')),

                    //array('label' => Yii::t('app', 'CompanyProfile'), 'url' => array('/companyprofile')),
                    //array('label' => Yii::t('app', 'Contact'), 'url' => array('/site/contact')),
                    //array('label' => Yii::t('app', 'Login'), 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                    //array('label' => Yii::t('app', 'Rights'), 'url' => array('/rights')),
                    //array('label' => Yii::t('app', 'User'), 'url' => array('/user')),

                    //array('label' => 'Product Master', 'url' => array('/productmaster/admin')),
                    //array('label' => 'Supplier Master', 'url' => array('/suppliermaster/admin')),
                    //array('label' => 'Purchase & Procurement', 'url' => array('')),
                    //array('label' => 'Requisition Number', 'url' => array('/transaction/admin')),
                   
                    
                                        
                    //array('label' => 'Requisition Head', 'url' => array('/requisitionhd/admin')),
                    //array('label' => 'Requisition Detail', 'url' => array('/requisitiondt/admin')),
                    
                    
                   // array('label' => 'Branch Master', 'url' => array('/branchmaster/admin')),
                   // array('label' => 'Codes Param', 'url' => array('/codesparam/admin')),
                    
                    //array('label' => 'Purchase Order Hd', 'url' => array('/purchaseordhd')),
                    //array('label' => 'Purchase Order Dt', 'url' => array('/purchaseorddt')),
                    
                    array('label' => 'Change Password', 'url' => array('/user/profile/changepassword')),
                    array('label' => 'Logout' . '('. Yii::app()->user->name .')', 'url' => array('/user/logout'), 'visible' => !Yii::app()->user->isGuest),

                    )));
                ?>

               
               
            </div>
        </div>
    </aside>
    <article class="main-content-holder">

    <?php echo $content; ?>
    
    
    </article>
</section>

	<footer class="footer">2012-2013 Copyright &copy; iTabps. All right reserved. </footer>
</div>
</body>
</html>
