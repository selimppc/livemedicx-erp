<?php
/* @var $this GrouponeController */
/* @var $model Groupone */

$this->breadcrumbs=array(
        'General Ledger',
        'Settings'=>array('transaction/glsettings'),
		'New Account Group',
);

$this->menu=array(
    array('label'=>'<< Back to Settings', 'url'=>array('transaction/glsettings')),
    array('label'=>'New Account Group', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	//array('label'=>'Manage Group One', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
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
        In this screen you need to fill in the fields, before clicking the button <b>"New Account Group"</b>, after clicking the button <b>"New Account Group"</b> An Account Group has been created on your right hand side table, under <b> Account Group Detail</b>.
        To create and setup Account Sub-Group, go to  <b> Account Group Detail</b> table, click the link under <b>Account group code</b>, this link will redirect you to entry screen for sub-group.
        You can go back to Settings to view all GL Setup tools by clicking the menu tab <b>“<< Back to Settings”</b>.
    </div>
</div>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>