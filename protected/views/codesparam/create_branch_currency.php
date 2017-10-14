<?php
$this->breadcrumbs=array(
	'Branch Master'=>array('branchmaster/admin'),
	'Settings >> New Branch Currency',
);

$this->menu=array(
	array('label'=>'New Branch Currency', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('codesparam/CreateBranchCurrency')),
    array('label'=>'Manage Branch Currency', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('branchmaster/BranchCurrency')),
		array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Currency', 'url'=>array('branchmaster/BranchCurrency')),
	),
	),
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
    <div id="flag_desc_text">New Unit Of Measurement</div>
</div>


<?php echo $this->renderPartial('_form_branch_currency', array('model'=>$model)); ?>
