<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
$this->breadcrumbs=array(
	UserModule::t("Login"),
);
?>

<h1><?php // echo UserModule::t("Login"); ?></h1>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<p><?php //echo UserModule::t("Please fill out the following form with your login credentials:"); ?></p>

<div class="form" id="login_div">

<?php echo CHtml::beginForm(array('/user/login')); ?>

    
    
         
	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php echo CHtml::errorSummary($model); ?>
	
	<?php Yii::app()->clientScript->registerScript(null,'$("#UserLogin_username").focus();') ?>
	
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'username'); ?>
		<?php echo CHtml::activeTextField($model,'username', array('id'=>'UserLogin_username')); ?>
		<?php echo CHtml::error($model,'username'); ?>
	</div>
	
	<div class="row">
		<?php echo CHtml::activeLabelEx($model,'password'); ?>
		<?php echo CHtml::activePasswordField($model,'password'); ?>
		<?php echo CHtml::error($model,'password'); ?>
	</div>
	

        <p>&nbsp;</p>
        
	<div class="row submit">
                    <?php echo CHtml::submitButton(UserModule::t("Login"), array('class'=>'submit_button')); ?> &nbsp; &nbsp; &nbsp; &nbsp; <?php echo CHtml::link(UserModule::t("Forgot Password ?"),Yii::app()->getModule('user')->recoveryUrl); ?>

	</div>
	
<?php echo CHtml::endForm(); ?>
</div><!-- form -->


<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>