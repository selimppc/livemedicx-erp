<?php
/* @var $this SmheaderController */
/* @var $model Smheader */

$this->breadcrumbs=array(
    'Sales',
	'Money Receipt'=>array('adminmoneyreceipt'),
	'Create'=>array('createmoneyreceipt'),
);

$this->menu=array(
	array('label'=>'<< Back to Money Receipt', 'url'=>array('adminmoneyreceipt')),
    //array('label'=>'Manage Money Receipt', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('smheader/adminmoneyreceipt')),
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
    <div id="flag_desc_text"><b>Money Receipt:</b>
        Fill in the <b>"Money Receipt" </b> as required. On your right hand side there are two separate tables. On the <b>"Unpaid Invoice List"</b> click under the <b>"Invoice No"</b> row for generating <b>Allocated Invoice</b> which will appear on the table <b>"Allocated Invoice"</b>. Click on <b>Save</b> button.
        <br>
        <span style="color: #008000; font-weight: bold;"> Note: Payment can be Part or Full. </span> <br>
        <span style="color: red; font-weight: bold;"> Warning: "Allocated Invoice" and "Payment Voucher" currency must remain the same </span>
    </div>
</div>


<?php $this->renderPartial('_form_money_receipt', array('model'=>$model, 'mralc'=>$mralc, 'cname'=>$cname, 'ramt'=>$ramt, 'sm_branch'=>$sm_branch )); ?>