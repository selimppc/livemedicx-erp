<?php
/* @var $this VwStockController */

$this->breadcrumbs=array(
	'Stock View '=>array('admin'),
	'Stock History',
);
?>

<style type="text/css">
    .red-alert{
        background-color: #FFB9B9;
    }
    .especial{
        background-color: #eeedeb;
    }

</style>

<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text"><b>Stock View:</b> In this screen you will be able to view all inventory stock history.</div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transferdt-grid',
    'rowCssClassExpression'=>'($data->available <= $data->cm_minlevel) ? "red-alert" : "especial" ',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cm_code',
		'cm_name',
		'im_BatchNumber',
		'im_ExpireDate',
		'im_storeid',
		'im_rate',
		'im_unit',
		'issueqty',
		'saleqty',
		'inhandqty',
		'available',
        //'cm_minlevel',
        array(
            'name' => 'cm_minlevel',
			'value' => $model->cm_minlevel,
            'htmlOptions'=>array('class'=>'cm_minlevel'),
            'visible'=>false,
		),
	),
)); ?>
