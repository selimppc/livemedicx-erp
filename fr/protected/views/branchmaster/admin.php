<?php
/* @var $this BranchmasterController */
/* @var $model Branchmaster */

$this->breadcrumbs=array(
	'Branch Masters'=>array('admin'),
	'Manage Branch Master',

);

$this->menu=array(
	//array('label'=>'List Branchmaster', 'url'=>array('index')),
	array('label'=>'Contrôle de la Nouvelle Branche', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Currency', 'url'=>array('branchmaster/BranchCurrency')),
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
        <b>Gérer le contrôle de la Branche</b>: Cet écran vous permettra de visualiser tous les détails de la Branche ; vous pouvez rechercher des données spécifiques en sélectionnant les  titres dans n'importe quelle colonne. En cliquant sur les icônes dans la colonne <b>"Acte"</b>, vous serez capable de mettre à  jour et de supprimer les données spécifiques. Vous pouvez également ouvrir un écran de saisie des données pour y entrer de nouvelles informations sur la branche en cliquant sur l'onglet <b>"Nouveau Contrôle de la Branche"</b>.
    </div>
</div>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'branchmaster-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cm_branch',
		//array(
		//	'class'=>'CLinkColumn',
        //    'header'=>'Branch Name',
        //    'labelExpression'=>'$data->cm_branch',
            //'urlExpression'=>'Yii::app()->createUrl("Purchaseorddt/PurchaseOrderNumberS1", array("pp_purordnum"=>$data->pp_purordnum))',
		//	'urlExpression'=>'array("branchcurrency/admin","cm_branch"=>$data->cm_branch)',
			//'linkHtmlOptions'=>array('target'=>'_blank'),

        //    ),
		'cm_currency',
        'cm_exchrate',
		'cm_description',
		'cm_contacperson',
		'cm_designation',
		'cm_mailingaddress',
		'cm_phone',
		/*
		'cm_cell',
		'cm_fax',
		'active',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
		*/
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
                    'Yii::app()->createUrl("branchmaster/view/", 
                                            array("cm_branch"=>$data->cm_branch, 
											))',
                ),
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("branchmaster/update/", 
                                            array("cm_branch"=>$data->cm_branch,
											))',
                ),
                'delete'=> array
                (
                    'url'=>
                    'Yii::app()->createUrl("branchmaster/delete/", 
                                            array("cm_branch"=>$data->cm_branch,
											))',
                ),
            ),
		),
	),
)); ?>
