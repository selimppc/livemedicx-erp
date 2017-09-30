<?php
/* @var $this RequisitiondtController */
/* @var $model Requisitiondt */

$this->breadcrumbs=array(
	'Requisition'=>array('requisitionhd/admin'),
	'New Requisition Entry Detail',
);

$this->menu=array(
	array('label'=>'<< Back to Requisition Header', 'url'=>array('requisitionhd/admin')),
	array('label'=>'New Requisition Detail', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('create', 'pp_requisitionno'=>$pp_requisitionno)),
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
        In this screen you need to fill in the fields, before clicking the button <b>“Add New Detail”</b>. Fields marked with (*) are mandatory. You can go back to Requisition Header to view all Requisition Header information at a glance by clicking the menu tab <b>“<< Go Back to Header”</b>. Action button will allow you to update and delete.
    </div>
</div>


<div style="width: 100%; float: left;">
	<div style="width: 48%; float: left; padding-right: 1%;">

        <h1 style="background: #FFCCFF; padding: 7px; width: 81%; font-weight: bold; text-align: center;">
            Fill in Requisition Details
        </h1>
		
		<?php $this->renderPartial('_form', array('model'=>$model, 'pp_requisitionno'=>$pp_requisitionno,)); ?>

	</div>
	
	<div style="width: 48%; float: left;">
        <h1 style="background: #FFCCFF; padding: 7px; width: 96%; font-weight: bold; text-align: center;">
            Requisition Entry Detail # <?php echo $pp_requisitionno; ?>
        </h1>

		
		<?php $this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'class-grid',
			'dataProvider'=>$reqDtSearch->search($pp_requisitionno),
			'filter'=>$reqDtSearch,
		
			'columns'=>array(
				'cm_code',
                array( 'name'=>'product_search', 'value'=>'$data->product->cm_name' ),
				'pp_quantity',
				//'pp_grnqty',
				'pp_unit',

                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{update}{delete}',
                    'header' => 'Action',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                    'buttons'=> array(

                        'update' => array(
                            'url'=>
                            'Yii::app()->createUrl("requisitiondt/update/",
                                                    array("id"=>$data->id, "pp_requisitionno"=>$data->pp_requisitionno))',
                        ),
                    ),

                ),
			
			))); ?>
		
	</div>
</div>
		