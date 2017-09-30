<?php
/* @var $this GrndetailController */
/* @var $model Grndetail */

$this->breadcrumbs=array(
	'GRN'=>array('purchaseordhd/ViewPurchaseOrderHd'),
	'Manage GRN'=>array('purchaseordhd/ViewGrn'),
);

$this->menu=array(
	array('label'=>'<< Back to GRN Manage', 'url'=>array('purchaseordhd/ViewGrn')),
	//array('label'=>'Create Grndetail', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create', 'vGrnNumber'=>$im_grnnumber, 'pp_purordnum'=>$im_purordnum,)),
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
    <div id="flag_desc_text"><b>GRN Details:</b> In this screen you will be able to view the <b>GRN</b> details. To back to GRN click the menu tab <b><< Back to GRN Manage</b></div>
</div>


<p> &nbsp; </p>

<b>PO NO:</b> <?php echo $im_purordnum; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<b>Date:</b> <?php echo $im_date; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<b>Supplier:</b> <?php echo $cm_orgname; ?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'grndetail-grid',
	'dataProvider'=>$model->search($im_grnnumber),
	'filter'=>$model,
	'columns'=>array(

		'im_grnnumber',
		'cm_code',
		'cm_name',
		'im_BatchNumber',
		'im_ExpireDate',
		'im_RcvQuantity',
		'im_costprice',
		'im_unit',
		'im_unitqty',
		'im_rowamount',

	
	),
)); ?>
