<?php
/* @var $this InvoicedtController */
/* @var $model Smdetail */

$this->breadcrumbs=array(
    'Sales',
	'Invoice'=>array('smheader/admin'),
	'New Invoice Details',
);

$this->menu=array(
    array('label'=>'<< Back to Invoice', 'url'=>array('invoicehd/create')),
    array('label'=>' Manage Invoice', 'url'=>array('smheader/admin')),
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
    <div id="flag_desc_text">In this screen you need to fill in the fields, before clicking the button <b>“Add Invoice Detail”</b>. Fields marked with (*) are mandatory. You can go back to Invoice Header to view all Invoice Header information at a glance by clicking the menu tab <b>“<< Back to Invoice”</b>.<b> Action</b> button will allow you to update and delete.  </div>
</div>






<div style="width: 100%; float: left;">
    <div style="width: 45%; float: left; ">
        <h1 style="background: #BA7F39; padding: 7px; width: 88%; font-weight: bold; border-radius: 5px; text-align: center;">
            New Invoice Order Details
        </h1>

        <?php $this->renderPartial('_form', array('model'=>$model, 'sm_date'=>$sm_date, 'sm_storeid'=>$sm_storeid,)); ?>

    </div>

    <div style="width: 55%; float: left;">

        <h1 style="background: #BA7F39; padding: 7px; width: 97%; font-weight: bold; border-radius: 5px; text-align: center;">
            Invoice Order # <?php echo $sm_number; ?> with detail
        </h1>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'purchaseorddt-grid',
            'dataProvider'=>$searchDetail->searchDetail($sm_number),
            'filter'=>$searchDetail,
            'columns'=>array(
                //'sm_number',
                'cm_code',
                array( 'name'=>'product_search', 'value'=>'$data->product->cm_name' ),
                'sm_unit_qty',
                'sm_unit',
                'sm_quantity',
                'sm_rate',
                'sm_tax_amt',
                'sm_lineamt',

                array(
                    'class'=>'CButtonColumn',
                    'header' => 'Action',
                    'template'=>'{update}{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'label'=>'update',
                            'url'=>
                                'Yii::app()->createUrl("invoicedt/update/",
                                                    array("id"=>$data->id, "sm_number"=>$data->sm_number,
                                                    ))',
                        ),

                    ),
                ),
            ),
        )); ?>

    </div>
</div>
