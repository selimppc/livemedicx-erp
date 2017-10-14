<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2> <?php // echo $code; ?></h2>

<div class="error" style="padding: 10px;">
<?php echo CHtml::encode($message); ?>
</div>