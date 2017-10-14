<?php
 Yii::app()->clientScript->scriptMap=array(
   'jquery.js'=>false,
 );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="UTF-8">
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
        
    </header>
    
    
<header class="header" id="sub-header">
    <div class="active-btn-holder">
    	<div id="icon_30x30_6_____" class="active-btn-icon_____"> 
    		<p style="color: white; padding: 17px 5px 0px 5px; ">ERP for Healthy Entrepreneurs</p>
    	</div>
    </div>
    <nav class="breadcrumb-holder">

<?php if (isset($this->breadcrumbs)): ?>
<?php
    $this->widget('zii.widgets.CBreadcrumbs', array(
    	'links' => $this->breadcrumbs,
    	'homeLink'=>false, // add this line
    	//'homeLink'=>CHtml::link('Home', array('site/administration')),
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

 <?php
     $username = Yii::app()->user->name;
     $user_type = User::model()->findByAttributes(array('username'=>$username))->user_type;
 ?>

 <?php  if( $user_type=='Admin'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(
             '<img src="'.Yii::app()->baseUrl.'/images/admin_a.png" /> Administration'=>
                 CHtml::link('Profil de l`Entreprise', array('/companyprofile/1'))."<br/>".
                 CHtml::link('Changer le mot de Pass', array('/user/profile/changepassword') )."<br />".
                 CHtml::link(Yii::t('User', 'Utilisateur'), array('/user/admin')),


             '<img src="'.Yii::app()->baseUrl.'/images/settings_a1.png" /> Master Setup'=>
                 CHtml::link('Maitrise du produit', array('/productmaster/admin'))."<br />".
                 CHtml::link('Contrôle du Service', array('/productmaster/service'))."<br />".
                 CHtml::link('Contrôle du fournisseur', array('/suppliermaster/admin'))."<br />".
                 CHtml::link('Contrôle du client', array('/customermst/admin'))."<br />".
                 CHtml::link('Contrôle de la Branche', array('/branchmaster/admin'))."<br />".
                 CHtml::link('Contrôler Devise', array('/currency/create'))."<br />".
                 CHtml::link('Configurations', array('/codesparam/masterSetup'))."<br />".
                 CHtml::link('Rapports', array('/sareport/masterSetupReports')) ,

             '<img src="'.Yii::app()->baseUrl.'/images/finance_a.png" /> General Ledger'=>
                 CHtml::link('Liste des comptes ', array('/chartofaccounts/admin'))."<br />".
                 CHtml::link('Livret de coupons', array('/journal/admin')) ."<br />".
                 CHtml::link('Payement du coupon', array('/journal/adminPayment')) ."<br />".
                 CHtml::link('Reception du coupon', array('/journal/adminReceipt')) ."<br />".
                 CHtml::link('Entrée inverse', array('/journal/adminReverse')) ."<br />".
                 CHtml::link('Configurations', array('/transaction/glsettings')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/GLReports')) ,


             '<img src="'.Yii::app()->baseUrl.'/images/purchase_a.png" /> Achat'=>
                 CHtml::link('Requisition', array('/requisitionhd/admin'))."<br />".
                 CHtml::link("Commande d'Achat", array('/purchaseordhd/admin'))."<br />".
                 CHtml::link('Configurations', array('/transaction/purchaseSettings'))."<br />".
                 CHtml::link('Rapports', array('/sareport/purchaseReports'))."<br />",

             '<img src="'.Yii::app()->baseUrl.'/images/accounts_a.png" /> Comptes À Payer'=>
                 CHtml::link('Facture', array('/vouhcerheader/apinvoice'))."<br />".
                 CHtml::link('Paiement', array('/vouhcerheader/appayment'))."<br />".
                 CHtml::link('Rapports', array('/sareport/apReports')),

             '<img src="'.Yii::app()->baseUrl.'/images/sales_a.png" /> Ventes'=>
                 CHtml::link('Entrer une facture', array('/smheader/admin'))."<br />".
                 CHtml::link('Les Ventes Directes', array('/smheader/directSaleAdmin'))."<br />".
                 CHtml::link("Réception d'argent", array('/smheader/adminmoneyreceipt'))."<br />".
                 CHtml::link('Configurations', array('/transaction/salesSettings'))."<br />".
                 CHtml::link('Rapports', array('/sareport/salesReports')),

             '<img src="'.Yii::app()->baseUrl.'/images/inventory_a.png" /> Inventaire'=>                        CHtml::link('AR ', array('/purchaseordhd/ViewPurchaseOrderHd'))."<br />".
                 CHtml::link('Vue sur le stock', array('/VwStock/admin')) ."<br />".
                 CHtml::link('Transfert du stock', array('/transferhd/admin')) ."<br />".
                 CHtml::link('Réception du stock', array('/transferhd/stockReceive')) ."<br />".
                 CHtml::link('Ajustement du stock', array('/adjusthd/admin')) ."<br />".
                 CHtml::link('Demande de livraison', array('/smheader/deliveryOrder')) ."<br />".
                 CHtml::link("IM to GL l'Interface", array('/itimtogl/create')) ."<br />".
                 CHtml::link('Configurations', array('/imtransaction/inventorySettings')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/inventoryReports')) ,
         ),
         // additional javascript options for the accordion plugin
         'options'=>array(
             //'clearStyle'=>true,
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             //'activate'=> true,
             //'selector'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,
             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),
         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
             //'onclick'=>'togglePanels("Inventory","h3")',
         ),

     )); ?>
 <?php }elseif($user_type=='Country Director + Finance'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(

             '<img src="'.Yii::app()->baseUrl.'/images/finance_a.png" /> General Ledger'=>
                 CHtml::link('Liste des comptes ', array('/chartofaccounts/admin'))."<br />".
                 CHtml::link('Livret de coupons', array('/journal/admin')) ."<br />".
                 CHtml::link('Payement du coupon', array('/journal/adminPayment')) ."<br />".
                 CHtml::link('Reception du coupon', array('/journal/adminReceipt')) ."<br />".
                 CHtml::link('Entrée inverse', array('/journal/adminReverse')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/GLReports')) ,


             '<img src="'.Yii::app()->baseUrl.'/images/purchase_a.png" /> Achat'=>
                 CHtml::link('Requisition', array('/requisitionhd/admin'))."<br />".
                 CHtml::link("Commande d'Achat", array('/purchaseordhd/admin'))."<br />".
                 CHtml::link('Rapports', array('/sareport/purchaseReports'))."<br />",

             '<img src="'.Yii::app()->baseUrl.'/images/accounts_a.png" /> Comptes À Payer'=>
                 CHtml::link('Facture', array('/vouhcerheader/apinvoice'))."<br />".
                 CHtml::link('Paiement', array('/vouhcerheader/appayment'))."<br />".
                 CHtml::link('Rapports', array('/sareport/apReports')),

             '<img src="'.Yii::app()->baseUrl.'/images/sales_a.png" /> Ventes'=>
                 CHtml::link('Entrer une facture', array('/smheader/admin'))."<br />".
                 CHtml::link('Les Ventes Directes', array('/smheader/directSaleAdmin'))."<br />".
                 CHtml::link("Réception d'argent", array('/smheader/adminmoneyreceipt'))."<br />".
                 CHtml::link('Rapports', array('/sareport/salesReports')),

             '<img src="'.Yii::app()->baseUrl.'/images/inventory_a.png" /> Inventory'=>
                 CHtml::link('AR ', array('/purchaseordhd/ViewPurchaseOrderHd'))."<br />".
                 CHtml::link('Vue sur le stock', array('/VwStock/admin')) ."<br />".
                 CHtml::link('Transfert du stock', array('/transferhd/admin')) ."<br />".
                 CHtml::link('Réception du stock', array('/transferhd/stockReceive')) ."<br />".
                 CHtml::link('Ajustement du stock', array('/adjusthd/admin')) ."<br />".
                 CHtml::link('Demande de livraison', array('/smheader/deliveryOrder')) ."<br />".
                 CHtml::link("IM to GL l'Interface", array('/itimtogl/create')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/inventoryReports')) ,
         ),
         'options'=>array(
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),
         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
         ),

     )); ?>
 <?php }elseif($user_type=='General Ledger'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(


             '<img src="'.Yii::app()->baseUrl.'/images/finance_a.png" /> General Ledger'=>
                 CHtml::link('Liste des comptes ', array('/chartofaccounts/admin'))."<br />".
                 CHtml::link('Livret de coupons', array('/journal/admin')) ."<br />".
                 CHtml::link('Payement du coupon', array('/journal/adminPayment')) ."<br />".
                 CHtml::link('Reception du coupon', array('/journal/adminReceipt')) ."<br />".
                 CHtml::link('Entrée inverse', array('/journal/adminReverse')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/GLReports')) ,


             '<img src="'.Yii::app()->baseUrl.'/images/accounts_a.png" /> Comptes À Payer'=>
                 CHtml::link('Facture', array('/vouhcerheader/apinvoice'))."<br />".
                 CHtml::link('Paiement', array('/vouhcerheader/appayment'))."<br />".
                 CHtml::link('Rapports', array('/sareport/apReports')),



         ),
         // additional javascript options for the accordion plugin
         'options'=>array(
             //'clearStyle'=>true,
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             //'activate'=> true,
             //'selector'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),

         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
             //'onclick'=>'togglePanels("Inventory","h3")',

         ),

     )); ?>
 <?php }elseif($user_type=='GL and Inventory'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(


             '<img src="'.Yii::app()->baseUrl.'/images/finance_a.png" /> General Ledger'=>
                 CHtml::link('Liste des comptes ', array('/chartofaccounts/admin'))."<br />".
                 CHtml::link('Livret de coupons', array('/journal/admin')) ."<br />".
                 CHtml::link('Payement du coupon', array('/journal/adminPayment')) ."<br />".
                 CHtml::link('Reception du coupon', array('/journal/adminReceipt')) ."<br />".
                 CHtml::link('Entrée inverse', array('/journal/adminReverse')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/GLReports')) ,

             '<img src="'.Yii::app()->baseUrl.'/images/accounts_a.png" /> Comptes À Payer'=>
                 CHtml::link('Facture', array('/vouhcerheader/apinvoice'))."<br />".
                 CHtml::link('Paiement', array('/vouhcerheader/appayment'))."<br />".
                 CHtml::link('Rapports', array('/sareport/apReports')),

             '<img src="'.Yii::app()->baseUrl.'/images/inventory_a.png" /> Inventaire'=>                        CHtml::link('AR ', array('/purchaseordhd/ViewPurchaseOrderHd'))."<br />".
                 CHtml::link('Vue sur le stock', array('/VwStock/admin')) ."<br />".
                 CHtml::link('Transfert du stock', array('/transferhd/admin')) ."<br />".
                 CHtml::link('Réception du stock', array('/transferhd/stockReceive')) ."<br />".
                 CHtml::link('Ajustement du stock', array('/adjusthd/admin')) ."<br />".
                 CHtml::link('Demande de livraison', array('/smheader/deliveryOrder')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/inventoryReports')) ,


         ),
         // additional javascript options for the accordion plugin
         'options'=>array(
             //'clearStyle'=>true,
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             //'activate'=> true,
             //'selector'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),

         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
             //'onclick'=>'togglePanels("Inventory","h3")',

         ),

     )); ?>
 <?php }elseif($user_type=='Inventory'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(


             '<img src="'.Yii::app()->baseUrl.'/images/inventory_a.png" /> Inventaire'=>                        CHtml::link('AR ', array('/purchaseordhd/ViewPurchaseOrderHd'))."<br />".
                 CHtml::link('Vue sur le stock', array('/VwStock/admin')) ."<br />".
                 CHtml::link('Transfert du stock', array('/transferhd/admin')) ."<br />".
                 CHtml::link('Réception du stock', array('/transferhd/stockReceive')) ."<br />".
                 CHtml::link('Ajustement du stock', array('/adjusthd/admin')) ."<br />".
                 CHtml::link('Demande de livraison', array('/smheader/deliveryOrder')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/inventoryReports')) ,


         ),
         // additional javascript options for the accordion plugin
         'options'=>array(
             //'clearStyle'=>true,
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             //'activate'=> true,
             //'selector'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),

         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
             //'onclick'=>'togglePanels("Inventory","h3")',

         ),

     )); ?>
 <?php }elseif($user_type=='Inventory Without Stock Adjustment'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(
             '<img src="'.Yii::app()->baseUrl.'/images/inventory_a.png" /> Inventaire'=>                        CHtml::link('AR ', array('/purchaseordhd/ViewPurchaseOrderHd'))."<br />".
                 CHtml::link('Vue sur le stock', array('/VwStock/admin')) ."<br />".
                 CHtml::link('Transfert du stock', array('/transferhd/admin')) ."<br />".
                 CHtml::link('Réception du stock', array('/transferhd/stockReceive')) ."<br />".
                 CHtml::link('Demande de livraison', array('/smheader/deliveryOrder')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/inventoryReports')) ,


         ),
         'options'=>array(
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),

         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
         ),

     )); ?>
 <?php }elseif($user_type=='Managers'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(
             '<img src="'.Yii::app()->baseUrl.'/images/settings_a1.png" /> Master Setup'=>
                 CHtml::link('Product Master', array('/productmaster/admin'))."<br />".
                 CHtml::link('Service Master', array('/productmaster/service'))."<br />".
                 CHtml::link('Supplier Master', array('/suppliermaster/admin'))."<br />".
                 CHtml::link('Customer Master', array('/customermst/admin'))."<br />".
                 CHtml::link('Branch Master', array('/branchmaster/admin'))."<br />".
                 CHtml::link('Currency Master', array('/currency/create'))."<br />".
                 CHtml::link('Settings', array('/codesparam/masterSetup'))."<br />".
                 CHtml::link('Reports', array('/sareport/masterSetupReports')) ,

             '<img src="'.Yii::app()->baseUrl.'/images/purchase_a.png" /> Achat'=>
                 CHtml::link('Requisition', array('/requisitionhd/admin'))."<br />".
                 CHtml::link("Commande d'Achat", array('/purchaseordhd/admin'))."<br />".
                 CHtml::link('Rapports', array('/sareport/purchaseReports'))."<br />",

             '<img src="'.Yii::app()->baseUrl.'/images/sales_a.png" /> Ventes'=>
                 CHtml::link('Entrer une facture', array('/smheader/admin'))."<br />".
                 CHtml::link('Les Ventes Directes', array('/smheader/directSaleAdmin'))."<br />".
                 CHtml::link("Réception d'argent", array('/smheader/adminmoneyreceipt'))."<br />".
                 CHtml::link('Rapports', array('/sareport/salesReports')),

             '<img src="'.Yii::app()->baseUrl.'/images/inventory_a.png" /> Inventory'=>
                 CHtml::link('AR ', array('/purchaseordhd/ViewPurchaseOrderHd'))."<br />".
                 CHtml::link('Vue sur le stock', array('/VwStock/admin')) ."<br />".
                 CHtml::link('Transfert du stock', array('/transferhd/admin')) ."<br />".
                 CHtml::link('Réception du stock', array('/transferhd/stockReceive')) ."<br />".
                 CHtml::link('Ajustement du stock', array('/adjusthd/admin')) ."<br />".
                 CHtml::link('Demande de livraison', array('/smheader/deliveryOrder')) ."<br />".
                 CHtml::link("IM to GL l'Interface", array('/itimtogl/create')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/inventoryReports')) ,

         ),
         'options'=>array(
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),
         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
         ),

     )); ?>
 <?php }elseif($user_type=='Purchase'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(


             '<img src="'.Yii::app()->baseUrl.'/images/purchase_a.png" /> Achat'=>
                 CHtml::link('Requisition', array('/requisitionhd/admin'))."<br />".
                 CHtml::link("Commande d'Achat", array('/purchaseordhd/admin'))."<br />".
                 CHtml::link('Rapports', array('/sareport/purchaseReports'))."<br />",

             '<img src="'.Yii::app()->baseUrl.'/images/settings_a1.png" /> Master Setup'=>
                 CHtml::link('Maitrise du produit', array('/productmaster/admin'))."<br />".
                 CHtml::link('Contrôle du Service', array('/productmaster/service'))."<br />".
                 CHtml::link('Contrôle du fournisseur', array('/suppliermaster/admin'))."<br />".
                 CHtml::link('Contrôle du client', array('/customermst/admin'))."<br />".
                 CHtml::link('Contrôle de la Branche', array('/branchmaster/admin'))."<br />".
                 CHtml::link('Contrôler Devise', array('/currency/create'))."<br />".
                 CHtml::link('Rapports', array('/sareport/masterSetupReports')) ,

         ),
         // additional javascript options for the accordion plugin
         'options'=>array(
             //'clearStyle'=>true,
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             //'activate'=> true,
             //'selector'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),

         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
             //'onclick'=>'togglePanels("Inventory","h3")',

         ),

     )); ?>
 <?php }elseif($user_type=='Purchase and Inventory'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(

             '<img src="'.Yii::app()->baseUrl.'/images/settings_a1.png" /> Master Setup'=>                     CHtml::link('Maitrise du produit', array('/productmaster/admin'))."<br />".
                 CHtml::link('Contrôle du Service', array('/productmaster/service'))."<br />".
                 CHtml::link('Contrôle du fournisseur', array('/suppliermaster/admin'))."<br />".
                 CHtml::link('Contrôle du client', array('/customermst/admin'))."<br />".
                 CHtml::link('Contrôle de la Branche', array('/branchmaster/admin'))."<br />".
                 CHtml::link('Contrôler Devise', array('/currency/create'))."<br />".
                 CHtml::link('Rapports', array('/sareport/masterSetupReports')) ,

             '<img src="'.Yii::app()->baseUrl.'/images/purchase_a.png" /> Achat'=>                          CHtml::link('Requisition', array('/requisitionhd/admin'))."<br />".
                 CHtml::link("Commande d'Achat", array('/purchaseordhd/admin'))."<br />".
                 CHtml::link('Rapports', array('/sareport/purchaseReports'))."<br />",


             '<img src="'.Yii::app()->baseUrl.'/images/inventory_a.png" /> Inventaire'=>                        CHtml::link('AR ', array('/purchaseordhd/ViewPurchaseOrderHd'))."<br />".
                 CHtml::link('Vue sur le stock', array('/VwStock/admin')) ."<br />".
                 CHtml::link('Transfert du stock', array('/transferhd/admin')) ."<br />".
                 CHtml::link('Réception du stock', array('/transferhd/stockReceive')) ."<br />".
                 CHtml::link('Ajustement du stock', array('/adjusthd/admin')) ."<br />".
                 CHtml::link('Demande de livraison', array('/smheader/deliveryOrder')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/inventoryReports')) ,



         ),
         // additional javascript options for the accordion plugin
         'options'=>array(
             //'clearStyle'=>true,
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             //'activate'=> true,
             //'selector'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),

         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
             //'onclick'=>'togglePanels("Inventory","h3")',

         ),

     )); ?>
 <?php }elseif($user_type=='Regional Director'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(

             '<img src="'.Yii::app()->baseUrl.'/images/settings_a1.png" /> Master Setup'=>
                 CHtml::link('Maitrise du produit', array('/productmaster/admin'))."<br />".
                 CHtml::link('Contrôle du Service', array('/productmaster/service'))."<br />".
                 CHtml::link('Contrôle du fournisseur', array('/suppliermaster/admin'))."<br />".
                 CHtml::link('Contrôle du client', array('/customermst/admin'))."<br />".
                 CHtml::link('Contrôle de la Branche', array('/branchmaster/admin'))."<br />".
                 CHtml::link('Contrôler Devise', array('/currency/create'))."<br />".
                 CHtml::link('Rapports', array('/sareport/masterSetupReports')) ,

             '<img src="'.Yii::app()->baseUrl.'/images/finance_a.png" /> General Ledger'=>
                 CHtml::link('Liste des comptes ', array('/chartofaccounts/admin'))."<br />".
                 CHtml::link('Livret de coupons', array('/journal/admin')) ."<br />".
                 CHtml::link('Payement du coupon', array('/journal/adminPayment')) ."<br />".
                 CHtml::link('Reception du coupon', array('/journal/adminReceipt')) ."<br />".
                 CHtml::link('Entrée inverse', array('/journal/adminReverse')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/GLReports')) ,


             '<img src="'.Yii::app()->baseUrl.'/images/purchase_a.png" /> Achat'=>
                 CHtml::link('Requisition', array('/requisitionhd/admin'))."<br />".
                 CHtml::link("Commande d'Achat", array('/purchaseordhd/admin'))."<br />".
                 CHtml::link('Rapports', array('/sareport/purchaseReports'))."<br />",

             '<img src="'.Yii::app()->baseUrl.'/images/accounts_a.png" /> Comptes À Payer'=>
                 CHtml::link('Facture', array('/vouhcerheader/apinvoice'))."<br />".
                 CHtml::link('Paiement', array('/vouhcerheader/appayment'))."<br />".
                 CHtml::link('Rapports', array('/sareport/apReports')),

             '<img src="'.Yii::app()->baseUrl.'/images/sales_a.png" /> Ventes'=>
                 CHtml::link('Entrer une facture', array('/smheader/admin'))."<br />".
                 CHtml::link('Les Ventes Directes', array('/smheader/directSaleAdmin'))."<br />".
                 CHtml::link("Réception d'argent", array('/smheader/adminmoneyreceipt'))."<br />".
                 CHtml::link('Rapports', array('/sareport/salesReports')),

             '<img src="'.Yii::app()->baseUrl.'/images/inventory_a.png" /> Inventory'=>
                 CHtml::link('AR ', array('/purchaseordhd/ViewPurchaseOrderHd'))."<br />".
                 CHtml::link('Vue sur le stock', array('/VwStock/admin')) ."<br />".
                 CHtml::link('Transfert du stock', array('/transferhd/admin')) ."<br />".
                 CHtml::link('Réception du stock', array('/transferhd/stockReceive')) ."<br />".
                 CHtml::link('Ajustement du stock', array('/adjusthd/admin')) ."<br />".
                 CHtml::link('Demande de livraison', array('/smheader/deliveryOrder')) ."<br />".
                 CHtml::link("IM to GL l'Interface", array('/itimtogl/create')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/inventoryReports')) ,

         ),
         'options'=>array(
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),
         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
         ),

     )); ?>
 <?php }elseif($user_type=='Sales'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(


             '<img src="'.Yii::app()->baseUrl.'/images/sales_a.png" /> Ventes'=>
                 CHtml::link('Entrer une facture', array('/smheader/admin'))."<br />".
                 CHtml::link('Les Ventes Directes', array('/smheader/directSaleAdmin'))."<br />".
                 CHtml::link("Réception d'argent", array('/smheader/adminmoneyreceipt'))."<br />".
                 CHtml::link('Rapports', array('/sareport/salesReports')),



         ),
         // additional javascript options for the accordion plugin
         'options'=>array(
             //'clearStyle'=>true,
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             //'activate'=> true,
             //'selector'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),

         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
             //'onclick'=>'togglePanels("Inventory","h3")',

         ),

     )); ?>
 <?php }elseif($user_type=='Sales and Inventory'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(


             '<img src="'.Yii::app()->baseUrl.'/images/sales_a.png" /> Ventes'=>
                 CHtml::link('Entrer une facture', array('/smheader/admin'))."<br />".
                 CHtml::link('Les Ventes Directes', array('/smheader/directSaleAdmin'))."<br />".
                 CHtml::link("Réception d'argent", array('/smheader/adminmoneyreceipt'))."<br />".
                 CHtml::link('Rapports', array('/sareport/salesReports')),


             '<img src="'.Yii::app()->baseUrl.'/images/inventory_a.png" /> Inventaire'=>                        CHtml::link('AR ', array('/purchaseordhd/ViewPurchaseOrderHd'))."<br />".
                 CHtml::link('Vue sur le stock', array('/VwStock/admin')) ."<br />".
                 CHtml::link('Transfert du stock', array('/transferhd/admin')) ."<br />".
                 CHtml::link('Réception du stock', array('/transferhd/stockReceive')) ."<br />".
                 CHtml::link('Ajustement du stock', array('/adjusthd/admin')) ."<br />".
                 CHtml::link('Demande de livraison', array('/smheader/deliveryOrder')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/inventoryReports')) ,

         ),
         // additional javascript options for the accordion plugin
         'options'=>array(
             //'clearStyle'=>true,
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             //'activate'=> true,
             //'selector'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),

         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
             //'onclick'=>'togglePanels("Inventory","h3")',

         ),

     )); ?>
 <?php }elseif($user_type=='Sales, Purchase and Inventory'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(

             '<img src="'.Yii::app()->baseUrl.'/images/purchase_a.png" /> Achat'=>
                 CHtml::link('Requisition', array('/requisitionhd/admin'))."<br />".
                 CHtml::link("Commande d'Achat", array('/purchaseordhd/admin'))."<br />".
                 CHtml::link('Rapports', array('/sareport/purchaseReports'))."<br />",

             '<img src="'.Yii::app()->baseUrl.'/images/sales_a.png" /> Ventes'=>
                 CHtml::link('Entrer une facture', array('/smheader/admin'))."<br />".
                 CHtml::link('Les Ventes Directes', array('/smheader/directSaleAdmin'))."<br />".
                 CHtml::link("Réception d'argent", array('/smheader/adminmoneyreceipt'))."<br />".
                 CHtml::link('Rapports', array('/sareport/salesReports')),

             '<img src="'.Yii::app()->baseUrl.'/images/inventory_a.png" /> Inventory'=>
                 CHtml::link('AR ', array('/purchaseordhd/ViewPurchaseOrderHd'))."<br />".
                 CHtml::link('Vue sur le stock', array('/VwStock/admin')) ."<br />".
                 CHtml::link('Transfert du stock', array('/transferhd/admin')) ."<br />".
                 CHtml::link('Réception du stock', array('/transferhd/stockReceive')) ."<br />".
                 CHtml::link('Ajustement du stock', array('/adjusthd/admin')) ."<br />".
                 CHtml::link('Demande de livraison', array('/smheader/deliveryOrder')) ."<br />".
                 CHtml::link("IM to GL l'Interface", array('/itimtogl/create')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/inventoryReports')) ,

         ),
         'options'=>array(
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),
         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
         ),

     )); ?>
 <?php }elseif($user_type=='Sales, Purchase, Inventory and GL'){ ?>
     <?php $this->widget('zii.widgets.jui.CJuiAccordion',array(
         'panels'=>array(

             '<img src="'.Yii::app()->baseUrl.'/images/finance_a.png" /> General Ledger'=>
                 CHtml::link('Liste des comptes ', array('/chartofaccounts/admin'))."<br />".
                 CHtml::link('Livret de coupons', array('/journal/admin')) ."<br />".
                 CHtml::link('Payement du coupon', array('/journal/adminPayment')) ."<br />".
                 CHtml::link('Reception du coupon', array('/journal/adminReceipt')) ."<br />".
                 CHtml::link('Entrée inverse', array('/journal/adminReverse')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/GLReports')) ,

             '<img src="'.Yii::app()->baseUrl.'/images/purchase_a.png" /> Achat'=>
                 CHtml::link('Requisition', array('/requisitionhd/admin'))."<br />".
                 CHtml::link("Commande d'Achat", array('/purchaseordhd/admin'))."<br />".
                 CHtml::link('Rapports', array('/sareport/purchaseReports'))."<br />",

             '<img src="'.Yii::app()->baseUrl.'/images/sales_a.png" /> Ventes'=>
                 CHtml::link('Entrer une facture', array('/smheader/admin'))."<br />".
                 CHtml::link('Les Ventes Directes', array('/smheader/directSaleAdmin'))."<br />".
                 CHtml::link("Réception d'argent", array('/smheader/adminmoneyreceipt'))."<br />".
                 CHtml::link('Rapports', array('/sareport/salesReports')),

             '<img src="'.Yii::app()->baseUrl.'/images/inventory_a.png" /> Inventory'=>
                 CHtml::link('AR ', array('/purchaseordhd/ViewPurchaseOrderHd'))."<br />".
                 CHtml::link('Vue sur le stock', array('/VwStock/admin')) ."<br />".
                 CHtml::link('Transfert du stock', array('/transferhd/admin')) ."<br />".
                 CHtml::link('Réception du stock', array('/transferhd/stockReceive')) ."<br />".
                 CHtml::link('Ajustement du stock', array('/adjusthd/admin')) ."<br />".
                 CHtml::link('Demande de livraison', array('/smheader/deliveryOrder')) ."<br />".
                 CHtml::link("IM to GL l'Interface", array('/itimtogl/create')) ."<br />".
                 CHtml::link('Rapports', array('/sareport/inventoryReports')) ,

         ),
         'options'=>array(
             'collapsible'=> true,
             'autoHeight'=>false,
             'active'=>true,
             'alwaysopen'=>true,
             'navigation'=>true,
             'hide'=>false,

             'icons'=>array(
                 "header"=>"ui-icon-plus",//ui-icon-circle-arrow-e, ui-icon-plus
                 "headerSelected"=>"ui-icon-circle-arrow-s",//ui-icon-circle-arrow-s, ui-icon-minus
             ),
         ),
         'htmlOptions'=>array(
             'style'=>'width:100%;',
         ),

     )); ?>
 <?php } ?>


 
                <?php $this->widget('zii.widgets.CMenu', array(
                'items' => array(
                    
                   // array('label' => 'Change Password', 'url' => array('/user/profile/changepassword')),
                    array('label' => 'Logout ('. Yii::app()->user->name .')', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/logout_a.png" /></span>{menu}',   'url' => array('/user/logout'), 'visible' => !Yii::app()->user->isGuest),

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
