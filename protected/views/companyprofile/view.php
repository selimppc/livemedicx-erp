<?php
/* @var $this CompanyprofileController */
/* @var $model Companyprofile */

$this->breadcrumbs=array(
	'Company Profile'=>array('view', 'id'=>$model->id),
	$model->title,
);

$this->menu=array(
	 array('label'=>'Update Company Profiles', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/update_a.png" /></span>{menu}', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<div style="width: 60%; float: left; padding: 10px; font-size: 14px; text-align: justify; ">
	<img src=" <?php echo Yii::app()->baseUrl.'/images/companyprofile/'.$model->photo ?>" /> 
	<p>&nbsp;</p>
	<h2><b><span style="color: #004D99;">WELCOME</span></b> <br><br> <span style="color: #CA1C00; text-transform:uppercase;"><b> <?php echo $model->title; ?> </span></b></h2>
	<p style="color: #444;"> </p><br>
	<h3><b><?php  echo $model->shortdescription; ?></b> </h3>
	
	<h4 style="color: #0000CD; line-height: 25px; font-size: 14px;"><?php echo $model->longdescription; ?> </h4><br>
	
	
</div>





