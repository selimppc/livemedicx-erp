<?php Yii::app()->clientscript->scriptMap['jquery.js'] = false; ?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'im_transfernum',
		'cm_code',
		'im_unit',
		'im_quantity',
		'im_rate',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
	),
)); ?>
ok

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'transferdt-grid',
	'dataProvider'=>$model->search($im_transfernum),
	//'filter'=>$model,
	'columns'=>array(
		
	),
)); ?>