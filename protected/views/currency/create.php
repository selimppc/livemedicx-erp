<?php
/* @var $this CurrencyController */
/* @var $model Currency */

$this->breadcrumbs=array(
    'Master Setup'=>array(''),
	'Currencies'=>array('create'),
	'Create',
);

$this->menu=array(
	array('label'=>'New Currency','template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}',  'url'=>array('create')),
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
        <b>Manage Currency Manage</b>: In this screen, all of the required fields need to be filled before clicking the button <b>“Add New Currency”</b>. Now you will be able to view the currency details table on your right-hand side. By clicking the icon under <b>“Action”</b> column will allow you to update the specific data.


    </div>
</div>
<br>
<div style="width: 98%; float: left;" >

    <div style="width: 46%; float: left;" >

        <h1 style="background: #FFCCFF; padding: 7px; width: 85%; text-align: center; font-weight: bold;">
            Fill in Currency Information
        </h1>

        <?php $this->renderPartial('_form', array('model'=>$model)); ?>

    </div>


    <div style="width: 54%; float: left; line-height: 8px;" >



        <h1 style="background: #FFCCFF; padding: 13px; width: 95%; text-align: center; font-weight: bold;">
            Currency Maintenance
        </h1>


        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'it-imtoap-grid',
            'dataProvider'=>Currency::model()->search(),
            //'filter'=>$model,
            'columns'=>array(
                'cm_currency',
                'cm_description',
                'cm_exchangerate',
                //'cm_active',
                array(
                    'name'=>'cm_active',
                    'filter'=>array('1'=>'YES','0'=>'NO'),
                    'value'=>'($data->cm_active=="1")?("YES"):("NO")'
                ),

                array(
                    'class'=>'CButtonColumn',
                    'header' => 'Action',
                    'template'=>'{update}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'label'=>'update',
                            'url'=>'Yii::app()->createUrl("currency/update/", array("id"=>$data->id))',
                            'options' => array(
                                //'onclick' => 'return getDisableButton()',
                                'id' => 'update-button',
                            ),
                        ),
                        /*
                            'delete' => array
                            (
                                'label'=>'delete',
                                'url'=>'Yii::app()->createUrl("currency/delete/", array("id"=>$data->id))',
                                //'visible'=>'Currency::model()->isNewRecord ? "echo Hello" : ""',
                                //'visible'=>'Currency::model()->isNewRecord ? true : false;',
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                                'options'=>array('id'=>'delete-btn'),
                            ),
                        */

                    ),
                ),
            ),
        )); ?>

    </div>

</div>

