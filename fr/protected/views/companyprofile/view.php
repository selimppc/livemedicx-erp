<?php
/* @var $this CompanyprofileController */
/* @var $model Companyprofile */

$this->breadcrumbs=array(
	'Company Profile'=>array('view', 'id'=>$model->id),
	$model->title,
);

$this->menu=array(
	// array('label'=>'Update Company Profiles', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/update_a.png" /></span>{menu}', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<div style="width: 60%; float: left; padding: 10px; font-size: 14px; text-align: justify; ">
	<img src=" <?php echo Yii::app()->baseUrl.'/images/companyprofile/'.$model->photo ?>" /> 
	<p>&nbsp;</p>
	<h2><span style="color: #004D99;">Bienvenu</span> <br><br> <span style="color: #CA1C00; text-transform:uppercase;">
			HAITI MEDICINE S.A.
			<?php // echo $model->title; ?> </span></h2>
	<p style="color: #444;"> </p><br>
	<h3><?php // echo $model->shortdescription; ?> </h3>
	
	<h4 style="color: #666; line-height: 25px; font-size: 14px;">
		<?php // echo $model->longdescription; ?>
		La  mission de Haiti Medicine S.A est de promouvoir la santé des Haitiens.La meilleure façon de le faire est de fournir des médicaments disponiblesde haute qualité (gardés en stock) et à  un prix abordable. Nous livrons directement aux missions,  cliniques et hôpitaux.  Nous nous asseyons ensemble avec ces organisations et planifions leur chaîne futur d'approvisionnement des besoins. Cela est nécessaire pour s'assurer que les médicaments sont sur les tablettes lorsque les patients en ont besoin.
	</h4><br>
	
	
</div>



<?php // $this->widget('zii.widgets.CDetailView', array(
	//'data'=>$model,
	//'id' => 'gridviewar',
	//'attributes'=>array(
		//'id',
		//'title',
		//'shortdescription',
		//'longdescription',
		//array(
			  // 'type'=>'image',
			  // 'name'=>'Photo',
			  // 'value'=> Yii::app()->baseUrl . "/images/companyprofile/" . $model->photo,
			  // 'htmlOptions'=>array('width'=>'50')),
	//),
//)); ?>



