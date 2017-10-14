<?php
/* @var $this CustomermstController */
/* @var $model Customermst */

$this->breadcrumbs=array(
	'Customer Master'=>array('admin'),
	'New Customer',
);

$this->menu=array(
	array('label'=>'Manage Customer', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}',  'url'=>array('admin')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Customer Group', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('codesparam/ManageCustomerGroup')),
				array('label'=>'Market', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('codesparam/ManageMarket')),
				array('label'=>'Customer TRN No', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('transaction/manageCustmerTrnNo')),
	),
	),*/
);
?>



<div id="statusMsg">
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-success").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::app()->user->hasFlash('error')):?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('error'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-error").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

</div>


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">
        <b>New Customer </b>: In this screen, all of the required fields need to be filled before clicking the button <b>“Save”</b>. Fields marked with (*) are mandatory. You can go back to your homescreen to view customer information(s) by clicking the menu tab <b>“Manage Customer”</b>.

    </div>
</div>




<?php $this->renderPartial('_form', array('model'=>$model)); ?>