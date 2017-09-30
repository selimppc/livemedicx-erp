<?php Yii::app()->clientscript->scriptMap['jquery.js'] = false; ?>
<?php
/* @var $this TransferdtController */
/* @var $model Transferdt */

$this->breadcrumbs=array(
    'Inventory',
	'Transfer'=>array('transferhd/admin'),
	'Transfer Detail',
);

$this->menu=array(
	array('label'=>'<< Back to Transfer Header', 'url'=>array('transferhd/admin')),
	//array('label'=>'New Transfer Detail', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create', 'im_transfernum'=>$im_transfernum)),
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
    <div id="flag_desc_text"> Transfer Detail according to Transfer NO # <?php echo $im_transfernum; ?></div>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transferdt-grid',
	'dataProvider'=>$model->search($im_transfernum),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		'im_transfernum',
		'cm_code',
        array( 'name'=>'product_search', 'value'=>'$data->product->cm_name' ),
		'im_unit',
		'im_quantity',
		'im_rate',
		/*
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
		*/

	),
)); ?>
