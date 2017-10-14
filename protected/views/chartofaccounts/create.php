<?php
/* @var $this ChartofaccountsController */
/* @var $model Chartofaccounts */

$this->breadcrumbs=array(
	'Chart of Account'=>array('admin'),
	'Create Chart of Account',
);

$this->menu=array(
    array('label'=>'New Chart of Account', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'Manage Chart of Account', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),

    /*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
        'items'=>array(
            array('label'=>'Group Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('groupone/create')),
            //array('label'=>'Group Two', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('grouptwo/createGroupTwo')),
            //array('label'=>'Group Three', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('groupthree/admin')),
            //array('label'=>'Default', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('amdefault/admin')),
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
        <b>New Chart of Account</b>: In this screen, all of the required fields need to be filled before clicking the button <b>“Add New A/C”</b>. Fields marked with (*) are mandatory. You can go back to your homescreen to view Chart of Account(s) by clicking the menu tab <b>“Manage Chart of Account”</b>.

    </div>
</div>


<div style="width: 99%; float: left;">
     <div style="width: 46%; float: left; margin-right: 3%;">
         <h1 style="text-align: center; font-weight: bold; background: #FFCCFF; padding: 7px; width: 95%; text-align: center;">
             Chart of Account Information
         </h1>
         <?php $this->renderPartial('_form', array('model'=>$model)); ?>
     </div>

    <div style="width: 51%; float: left; ">

        <h1 style="text-align: center; font-weight: bold; background: #FFCCFF; padding: 8px; width: 95%; text-align: center;">
            Chart of Account Maintenance
        </h1>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'chartofaccounts-grid',
            'dataProvider'=>$coa->searchNew(),
            'filter'=>$coa,
            'columns'=>array(
                'am_accountcode',
                'am_description',
                'am_accounttype',
                //'am_accountusage',
                //'am_groupone',
                //'am_grouptwo',
                //'am_groupthree',
                //'am_analyticalcode',
                //'am_status',

                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{update}{delete}',
                    'header'=>'Action',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
                ),

            ),
        )); ?>
    </div>
</div>





