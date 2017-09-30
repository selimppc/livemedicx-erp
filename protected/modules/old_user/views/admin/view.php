<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('admin'),
	$model->username,
);


$this->menu=array(
    array('label'=>UserModule::t('Create User'), 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
    array('label'=>UserModule::t('Update User'), 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/update_a.png" /></span>{menu}', 'url'=>array('update','id'=>$model->id)),
    //array('label'=>UserModule::t('Delete User'), 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>UserModule::t('Are you sure to delete this item?'))),
    array('label'=>UserModule::t('Manage Users'), 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('/user/admin')),
    //array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
    //array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
);
?>
<h1><?php echo UserModule::t('View User').' "'.$model->username.'"'; ?></h1>

<?php
 
	$attributes = array(
		'id',
		'username',
	);
	
	$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'type'=>'raw',
					'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),
				));
		}
	}
	
	array_push($attributes,
		'password',
		'email',
        //'employeeid',
		'employeebranch',
        'user_type',
		//'activkey',
		'create_at',
		'lastvisit_at'
//		array(
//			'name' => 'superuser',
//			'value' => User::itemAlias("AdminStatus",$model->superuser),
//		),
//		array(
//			'name' => 'status',
//			'value' => User::itemAlias("UserStatus",$model->status),
//		)
	);
	
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));
	

?>
