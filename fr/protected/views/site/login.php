<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>


<div class="form" id="login_form">
<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl('//user/login'),
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
        'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<!--<div class="row rememberMe">
		<?php //echo $form->checkBox($model,'rememberMe'); ?>
		<?php //echo $form->label($model,'rememberMe'); ?>
		<?php //echo $form->error($model,'rememberMe'); ?>
	</div> -->
        
        <p>&nbsp;</p>
        
	<div class="row buttons">
                    <?php echo CHtml::submitButton('Login', array('class'=>'submit_button')); ?>

	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
