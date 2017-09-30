<?php
/* @var $this SuppliermasterController */
/* @var $model Suppliermaster */

$this->breadcrumbs=array(
	'Supplier Masters'=>array('admin'),
	'Manage Supplier',
);

$this->menu=array(
	//array('label'=>'List Supplier Master', 'url'=>array('index')),
	array('label'=>'Nouveau fournisseur', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
		/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Supplier Group Manage', 'url'=>array('suppliermaster/SupplierGroup')),
	),
	),*/
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
    <div id="flag_desc_text">
        <b>Gérer le contrôle du fournisseur</b>:
        Cet écran vous permettra de visualiser tous les détailsdu fournisseur ; vous pouvez rechercher des données spécifiques en sélectionnant les  titres dans n'importe quelle colonne. En cliquant sur les icônes dans la colonne <b>"Acte"</b>, vous serez capable de mettre à  jour et de supprimer les données spécifiques. Vous pouvez également ouvrir un écran de saisie des données pour y entrer de nouvelles informations sur fournisseur en cliquant sur l'onglet  du menu <b>"Nouveau Contrôle du fournisseur"</b>.

    </div>
</div>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'suppliermaster-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cm_supplierid',
		'cm_group',
		'cm_orgname',
		//'cm_address',
		//'cm_district',
		//'cm_post',
		
		//'cm_policest',
		//'cm_postcode',
		//'cm_contactperson',
		//'cm_phone',
		'cm_cellphone',
		//'cm_fax',
		'cm_email',
		//'cm_url',
        array(
            'name'=>'cm_status',
            'filter'=>array('1'=>'Open','0'=>'Closed'),
            'value'=>'($data->cm_status=="1")?("Open"):("Closed")'
        ),
		//'inserttime',
		//'updatetime',
		//'insertuser',
		//'updateuser',
		
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
                    'Yii::app()->createUrl("suppliermaster/view/", 
                                            array("cm_supplierid"=>$data->cm_supplierid, 
											))',
                ),
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("suppliermaster/update/", 
                                            array("cm_supplierid"=>$data->cm_supplierid,
											))',
                ),
                'delete'=> array
                (
                    'url'=>
                    'Yii::app()->createUrl("suppliermaster/delete/", 
                                            array("cm_supplierid"=>$data->cm_supplierid,
											))',
                ),
            ),
		),
	),
)); ?>
