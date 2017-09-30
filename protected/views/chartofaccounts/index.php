<?php
/* @var $this ChartofaccountsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Chart of Accounts',
);

$this->menu=array(
	array('label'=>'Create Chart of Accounts', 'url'=>array('create')),
	array('label'=>'Manage Chart of Accounts', 'url'=>array('admin')),
);
?>


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">Chart of Accounts</div>
</div>



<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
