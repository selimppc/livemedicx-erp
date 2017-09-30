<?php
/* @var $this CompanyprofileController */
/* @var $model Companyprofile */

$this->breadcrumbs=array(
	'Company Profile'=>array('view', 'id'=>$model->id),
	//$model->title=>array('view','id'=>$model->id),
	'Update Company Profile',
);

$this->menu=array(
	//array('label'=>'List Company Profiles', 'url'=>array('index')),
	//array('label'=>'Create Company Profiles', 'url'=>array('create')),
	array('label'=>'View Company Profile', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Company Profiles', 'url'=>array('admin')),
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
        <div id="flag_desc_text">Update Company Profile</div>
    </div>



<?php $this->renderPartial('_form', array('model'=>$model)); ?>