<?php
/* @var $this PurchaseorddtController */
/* @var $model Purchaseorddt */

$this->breadcrumbs=array(
	'Purchase'=>array('purchaseordhd/admin'),
	'New Purchase Order Detail',
);

$this->menu=array(
	array('label'=>'<< Go Back to Header', 'url'=>array('purchaseordhd/admin')),
	array('label'=>'New Purchase Order Details', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('create', 'pp_purordnum'=>$pp_purordnum,)),
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
    <div id="flag_desc_text">In this screen you need to fill in the fields, before clicking the button <b>“Add Purchase Detail”</b>. Fields marked with (*) are mandatory. You can go back to Purchase Header to view all Purchase Header information at a glance by clicking the menu tab <b>“<< Go Back to Header”</b>.<b> Action</b> button will allow you to update and delete.  </div>
</div>

<div style="width: 100%; float: left;">
	<div style="width: 45%; float: left; ">
        <h1 style="background: #FFCCFF; padding: 7px; width: 88%; font-weight: bold; border-radius: 5px; text-align: center;">
            New Purchase Order Details
        </h1>


		<?php $this->renderPartial('_form', array('model'=>$model)); ?>

	</div>
	
	<div style="width: 55%; float: left;">

        <h1 style="background: #FFCCFF; padding: 7px; width: 97%; font-weight: bold; border-radius: 5px; text-align: center;">
            Purchase Order # <?php echo $pp_purordnum; ?> with detail
        </h1>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'purchaseorddt-grid',
            'dataProvider'=>$searchDetail->searchDetail($pp_purordnum),
            'filter'=>$searchDetail,
            'columns'=>array(
                //'pp_purordnum',
                'cm_code',
                array( 'name'=>'product_search', 'value'=>'$data->product->cm_name' ),
                'pp_quantity',
                'pp_rowamt',

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
                            'Yii::app()->createUrl("purchaseorddt/update/",
                                                    array("id"=>$data->id, "pp_purordnum"=>$data->pp_purordnum,
                                                    ))',
                        ),

                    ),
                ),
            ),
        )); ?>
		
	</div>
</div>



