<?php
$this->breadcrumbs=array(
    'Master Setup',
	'Settings'=>array('codesparam/masterSetup'),
	'Customer District Code',
);

$this->menu=array(
    array('label'=>'<< Back to Settings', 'url'=>array('codesparam/masterSetup')),
	array('label'=>'New Customer District Code', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('transaction/createCustomerDistrictCode')),

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
        <b>Customer District Code</b>: In this screen, all of the required fields need to be filled before clicking the button <b>“Enter District Code”</b>. Fields marked with (*) are mandatory. You can go back to your home screen to view all business setup tool(s) by clicking the menu tab <b>“Back to Settings”</b>.

    </div>
</div>


<div style="width: 98%; float: left;">
    <div style="width: 47%; float: left; margin-right: 3%;">
        <?php echo $this->renderPartial('_from_customer_district_code', array('model'=>$model)); ?>
    </div>
    <div style="width: 50%; float: left;">
        <h1 style="background: #FFCCFF; padding: 7px; width: 97%; font-weight: bold; border-radius: 5px; text-align: center;">
            Customer District Code Details
        </h1>
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'class-grid',
            'dataProvider'=>$data,

            'columns'=>array(
                'cm_type',
                'cm_trncode',
				'cm_branch',
                'cm_lastnumber',
                'cm_increment',
                //'cm_active',



            ))); ?>
    </div>

</div>

