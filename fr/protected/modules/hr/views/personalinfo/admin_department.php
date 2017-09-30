<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(
	'Employee Info'=>array('admin'),
	'Settings >> Manage Department',
);

$this->menu=array(
	array('label'=>'New Department', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('CreateDepartment')),
    array('label'=>'Manage Department', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('AdminDepartment')),
);




Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#productmaster-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<h1> Department</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$result,
	'columns'=>array(
		'cm_type',
		'cm_code',
		'cm_desc',
		'cm_active',
		//'inserttime',
		//'updatetime',
		'insertuser',
		//'updateuser',

    	
        array(
            'class'=>'CButtonColumn',
			'header'=>'Action',
            'template'=>'{delete}',
            'buttons'=>array
            (
	
                'delete'=> array
                (
                    'url'=>
                    'Yii::app()->createUrl("codesparam/delete/", 
                                            array("cm_type"=>$data->cm_type, "cm_code"=>$data->cm_code
											))',
                ),
            ),
        ),
	),
)); ?>
