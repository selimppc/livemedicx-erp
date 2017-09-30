<?php
/* @var $this AmdefaultController */
/* @var $model Amdefault */

$this->breadcrumbs=array(
        'General Ledger'=>array(''),
		'Chart of Accounts'=>array('chartofaccounts/admin'),
		'Settings'=>array(''),
		'Defaults',
);
$this->menu=array(
	//array('label'=>'New Am Default', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
);

?>
<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">Fiscal Year and period will default according to Chart Of Accounts</div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'amdefault-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'am_offset',
		'am_pnlacount',
		'am_year',
		'am_period',

		//array(
			//'class'=>'CButtonColumn',
		//),
	),
)); ?>
