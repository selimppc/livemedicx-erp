<?php
/* @var $this JournalController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
    'General Ledger'=>array(''),
    'Reverse Entry'=>array('adminReverse'),
);

$this->menu=array(
	//array('label'=>'List Vouhcerheader', 'url'=>array('index')),
	array('label'=>'Nouvelle Entrée inverse', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('createReverse')),
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
        <b>Gérer une Entrée inversée</b>:
        Cet écran vous permettra de visualiser l'ensemble des détail d'une Entrée inverse; vous pouvez rechercher des données spécifiques en sélectionnant n'importe quel titre des colonnes .  En cliquant sur les icônes dans la colonne <b>"Acte"</b>,  vous serez capable de mettre à  jour et de supprimer. Vous pouvez également ouvrir un écran de saisie de données pour entrer les informations sur une nouvelle entrée inverse  en cliquant sur l'onglet du Menu"Nouvelle Entrée inverse" . Vous pouvez aussi afficher les rapports en cliquant sur l'icône de pdf ou xls dans la colonne <b>«Rapports»</b>.


    </div>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'vouhcerheader-grid',
	'dataProvider'=>$model->searchReverseEntry(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'am_vouchernumber',
        array(
            'class'=>'CLinkColumn',
            'header'=>'Numero du coupon',
            'labelExpression'=>'$data->am_vouchernumber',
            //'urlExpression'=>'array("journaldt/createReverse", "am_vouchernumber"=>$data->am_vouchernumber )',
            'urlExpression'=>'$data->am_status!=="Posted" ? array("journaldt/createReverse","am_vouchernumber"=>$data->am_vouchernumber) :
                            array("journaldt/AdminViewReverse","am_vouchernumber"=>$data->am_vouchernumber)',
        ),
		'am_date',
		'am_referance',
		'am_year',
		'am_period',
		'am_branch',
		'am_note',
		'am_status',
		array(
			'class'=>'CButtonColumn',
            'header'=>'Acte',
            'template'=>'{update}{delete}',

            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

            'buttons'=>array
            (
                'update' => array
                (
                    'label'=>'update',
                    'visible'=>'$data->am_status!=="Posted"',
					'url'=>'Yii::app()->createUrl("journal/updateReverse/",array("id"=>$data->id,))',
                ),

                'delete' => array
                (
                    'label'=>'delete',
                    'visible'=>'$data->am_status!=="Posted"',
                ),
            ),
		),

        array(
            'class'=>'CButtonColumn',
            'header' => 'Rapports',
            'template'=>'{toPDF}{toExcel}',
            'buttons'=>array
            (
                'toPDF' => array
                (
                    'label'=>'toPDF',
                    'url'=>'Yii::app()->createUrl("sareport/singleVoucher/", array("pVoucherNo"=>$data->am_vouchernumber) )',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_pdf.png',
                    'options'=>array('target'=>'_blank'),
                ),
                'toExcel' => array
                (
                    'label'=>'toExcel',
                    'url'=>'Yii::app()->createUrl("sareport/singleVoucher/", array("pVoucherNo"=>$data->am_vouchernumber) )',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_xls.png',
                    'options'=>array('target'=>'_blank'),
                ),
            ),
        ),

	),
)); ?>
