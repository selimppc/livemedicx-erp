<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(
	'Product Masters'=>array('admin'),
	//$model->cm_code,
	'View Product Master'
);

$this->menu=array(
	// array('label'=>'List Productmaster', 'url'=>array('index')),
	array('label'=>'New Product Master', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	//array('label'=>'Update Product Master', 'url'=>array('update', 'id'=>$model->cm_code)),
	//array('label'=>'Delete Product Master', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cm_code),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Product Master', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>



<div id="statusMsg">
    <?php if(Yii::app()->user->hasFlash('success')):?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-success").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

    <?php if(Yii::app()->user->hasFlash('error')):?>
        <div class="flash-error">
            <?php echo Yii::app()->user->getFlash('error'); ?>
            <?php

            Yii::app()->clientScript->registerScript(
                'myHideEffect',
                '$(".flash-error").animate({opacity: 1.0}, 9000).fadeOut("slow");',
                CClientScript::POS_READY
            );
            ?>
        </div>
    <?php endif; ?>

</div>


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">View Product Master # <?php echo $model->cm_name; ?></div>
</div>

<?php if(!empty($model->image)){ ?>
    <img src="<?php echo $model->image ?>" width="300">
<?php }else{ ?>
     <img src="<?php echo Yii::app()->baseUrl.'/images/product_icon.png' ?>" width="300">
<?php } ?>
<p>&nbsp;</p>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cm_code',
		'cm_name',
		'cm_description',
		'cm_class',
		'cm_group',
		'cm_category',
		'cm_sellrate',
		'cm_costprice',
		'cm_sellunit',
		'cm_sellconfact',
		'cm_purunit',
		'cm_purconfact',
		'cm_stkunit',
		'cm_stkconfac',
		'cm_packsize',
		'cm_stocktype',
		'cm_supplierid',
		'cm_minlevel',
        'image'

	),
)); ?>
