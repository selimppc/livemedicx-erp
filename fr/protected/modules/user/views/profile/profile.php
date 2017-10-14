<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile"),
);
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'),  'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('/user/admin'))
		:array()),
    //array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Edit'), 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/update_a.png" /></span>{menu}', 'url'=>array('edit')),
    array('label'=>UserModule::t('Change password'), 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array('changepassword')),
    //array('label'=>UserModule::t('Logout'), 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/logout_a.png" /></span>{menu}', 'url'=>array('/user/logout')),
);
?>

<h2>Welcome <?php echo CHtml::encode($model->username); ?></h2>

<br>
<h1><?php echo UserModule::t('Your profile'); ?></h1>
<br>
<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>

<?php endif; ?>



<table class="dataGrid" style="float: left; width: 40%; text-align: left; ">
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
	    <td><?php echo CHtml::encode($model->username); ?></td>
	</tr>
	<?php 
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
				//echo "<pre>"; print_r($profile); die();
			?>
	<tr>
		<th class="label"><?php echo CHtml::encode(UserModule::t($field->title)); ?></th>
    	<td><?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?></td>
	</tr>
			<?php
			}//$profile->getAttribute($field->varname)
		}
	?>
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
    	<td><?php echo CHtml::encode($model->email); ?></td>
	</tr>
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
    	<td><?php echo $model->create_at; ?></td>
	</tr>
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
    	<td><?php echo $model->lastvisit_at; ?></td>
	</tr>
	<tr>
		<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
    	<td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status)); ?></td>
	</tr>
        
        
</table>
