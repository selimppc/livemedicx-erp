<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('/user'),
	UserModule::t('Manage'),
);

$this->menu=array(
    array('label'=>UserModule::t('Create User'), 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
    array('label'=>UserModule::t('Manage Users'), 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('/user/admin')),
    //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    //array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);


?>
<h1><?php echo UserModule::t("Manage Users"); ?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//array(
			//'name' => 'id',
			//'type'=>'raw',
			//'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
		//),
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
//        array(
//			'name'=>'employeeid',
//			'type'=>'raw',
//			'value'=>'CHtml::link(UHtml::markSearch($data,"employeeid"),array("admin/view","id"=>$data->id))',
//		),
		'employeebranch',
        'user_type',
		'create_at',
		'lastvisit_at',
//		array(
//			'name'=>'superuser',
//			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
//			'filter'=>User::itemAlias("AdminStatus"),
//		),
//		array(
//			'name'=>'status',
//			'value'=>'User::itemAlias("UserStatus",$data->status)',
//			'filter' => User::itemAlias("UserStatus"),
//		),
		array(
			'class'=>'CButtonColumn',
            'header'=>'Action',
		),
	),
)); ?>
