<?php
$this->breadcrumbs=array(
	'Payroll'=>array('admin'),
	'Settings',
	'HR Transaction',
);

$this->menu=array(
	array('label'=>'New HR Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('payroll/CreateHrTransaction')),
    array('label'=>'Manage HR Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('payroll/ManageHrTransaction')),
		array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'HR Transaction', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('payroll/ManageHrTransaction')),
	),
	),
);
?>

<h1> Manage HR Transaction</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$result,
	
	'columns'=>array(
		'cm_type',
		'cm_trncode',
		'cm_lastnumber',
		'cm_increment',
		'cm_active',
		array(
            'class'=>'CButtonColumn',
			'header'=>'Action',
            'template'=>'{delete}',
            'buttons'=>array
            (

                'delete'=> array
                (
                    'url'=>
                    'Yii::app()->createUrl("transaction/delete/", 
                                            array("cm_type"=>$data->cm_type, "cm_trncode"=>$data->cm_trncode
											))',
                ),
            ),
        ),
		
))); ?>

