<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(
	'Maitrise du produit'=>array('admin'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Product Master', 'url'=>array('index')),
	array('label'=>'Nouveau Maitrise du produit', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create') ),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Product Class Manage', 'url'=>array('productmaster/ProductClass')),
				array('label'=>'Product Group Manage', 'url'=>array('productmaster/ProductGroup')),
				array('label'=>'Product Category Manage', 'url'=>array('productmaster/ProductCategory')),
				array('label'=>'Unit Of Measurement Manage', 'url'=>array('productmaster/UnitOfMeasurement')),
	),
	),*/
);

?>

<style type="text/css">
.product-image img{
	width: 30px;
}

</style>


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
    <div id="flag_desc_text">
        <b>Gérer le contrôle des produits</b>: Cet écran vous permettra de visualiser la description générale du produit; vous pouvez rechercher un objet spécifique en sélectionnant les titres dans les colonnes . La colonne Activité vous permettra de mettre à  jour et de supprimer l'élément spécifique.
       </div>
</div>





<?php // echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php  $this->renderPartial('_search',array(
	 'model'=>$model,
)); ?>
</div><!-- search-form -->




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'productmaster-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'cm_code',
			'htmlOptions'=>array('style'=>'width: 100px; text-align: left;'),
		),
		array(
				'name'=>'image',
				'type' => 'html',
				//'value'=>'!empty($data->image)?CHtml::image(Yii::app()->baseUrl.$data->image):CHtml::image(Yii::app()->baseUrl."/images/product_icon.png")',
				'value'=>'!empty($data->image)?CHtml::image($data->image):CHtml::image(Yii::app()->baseUrl."/images/product_icon.png")',
				'htmlOptions'=>array(
                    'style'=>'width: 50px; text-align: center; cursor: pointer', 'class'=>'product-image',
                ),

		),

        'cm_name',
		'cm_description',
		'cm_class',
        'cm_category',
		'cm_group',


		array(
			'class'=>'CButtonColumn',
			'header' => 'Acte',
			'template'=>'{view}{update}{delete}',

            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',


            'buttons'=>array
            (
                'view' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("productmaster/view/", 
                                            array("cm_code"=>$data->cm_code, 
											))',
                ),
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("productmaster/update/", 
                                            array("cm_code"=>$data->cm_code,
											))',
                ),
                'delete'=> array
                (
                    'url'=>
                    'Yii::app()->createUrl("productmaster/delete/", 
                                            array("cm_code"=>$data->cm_code,
											))',
                ),
            ),
		),
	),
)); ?>




