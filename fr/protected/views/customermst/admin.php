<?php
/* @var $this CustomermstController */
/* @var $model Customermst */

$this->breadcrumbs=array(
	'Customer Master'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Nouveau Client', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}',  'url'=>array('create')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Customer Group', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('codesparam/ManageCustomerGroup')),
				array('label'=>'Market', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('codesparam/ManageMarket')),
				array('label'=>'Customer TRN No', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('transaction/manageCustmerTrnNo')),
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
        <b>Gérer le contrôle du client</b>: Cet écran vous permettra de visualiser tous les détails du client ; vous pouvez rechercher des données spécifiques en sélectionnant les  titres dans n'importe quelle colonne. En cliquant sur les icônes dans la colonne <b>"Acte"</b>, vous serez capable de mettre à  jour et de supprimer les données spécifiques. Vous pouvez également ouvrir un écran de saisie des données pour y entrer de nouvelles informations sur le client en cliquant sur l'onglet du menu <b>"Nouveau Contrôle du Client"</b>.
    </div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customermst-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cm_group',
		'cm_cuscode',
		'cm_name',
		'cm_address',
		//'cm_territory',
		'cm_cellnumber',
		'cm_phone',
		'c_type',
		'cm_fax',
		'cm_email',
		'cm_branch',
		'cm_market',
		'cm_sp',

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
                    'Yii::app()->createUrl("customermst/view/", 
                                            array("cm_cuscode"=>$data->cm_cuscode, 
											))',
                ),
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("customermst/update/", 
                                            array("cm_cuscode"=>$data->cm_cuscode,
											))',
                ),
                'delete'=> array
                (
                    'url'=>
                    'Yii::app()->createUrl("customermst/delete/", 
                                            array("cm_cuscode"=>$data->cm_cuscode,
											))',
                ),
            ),
		),
	),
)); ?>
