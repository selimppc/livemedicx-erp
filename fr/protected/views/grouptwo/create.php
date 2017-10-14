<?php
/* @var $this GrouptwoController */
/* @var $model Grouptwo */

$this->breadcrumbs=array(
    'General Ledger',
    'Settings'=>array('transaction/glsettings'),
	'New Account Sub-Group',
);

$this->menu=array(
    array('label'=>'<< Back to Settings', 'url'=>array('transaction/glsettings')),
    array('label'=>'<< Back to Account Group', 'url'=>array('groupone/create')),
	//array('label'=>'Manage Group Two', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
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
        In this screen you need to fill in all the fields, before clicking the button <b>"Enter Sub Group"</b>, a Sub Group table has been created on your right hand side, under <b>Sub Group Details</b>. The table gives you options to update or delete Sub-group data from <b>Action</b> column.
        You can go back to the Settings for viewing all GL Setup tools by clicking the menu tab <b>“<< Back to Settings”</b>.

    </div>
</div>



<?php $this->renderPartial('_form', array('model'=>$model, 'group1'=>$group1 )); ?>