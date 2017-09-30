<?php
/* @var $this PurchaseordhdController */
/* @var $model Purchaseordhd */

$this->breadcrumbs=array(
	'Purchase'=>array('admin'),
	'Manage Purchase Order Header',
);

$this->menu=array(
	//array('label'=>'List Purchase Order', 'url'=>array('index')),
	array('label'=>"En-tête d'une nouvelle commande d'Achat", 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Purchase Order Number', 'url'=>array('transaction/ManagePurchaseOrdNum')),
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
        <b>Gérer l'entête  du bon de commande </b>: Cet écran vous permettra de visualiser l'ensemble des détails de l'en-tête du bon de commande;  vous pouvez rechercher les données spécifiques en sélectionnant n'importe quel  titre des colonnes. En cliquant sur les icônes dans la colonne <b>"Acte"</b> , vous serez capable de mettre à  jour et de supprimer. Vous pouvez également ouvrir un écran de saisie de données pour entrer les informations sur la  nouvelle entrée inverse  en cliquant sur l'onglet du Menu <b>"En-tête de la nouvelle demande"</b>. Vous pouvez aussi annuler un bon de commande  en cliquant sur l'icône <b>"Annuler une Commande d'Achat "</b> dans la colonne <b>"Annuler une commande d'Achat"</b>.

    </div>
</div>


<div style="width: 99%; float: left;">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'purchaseordhd-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		// 'id',
		//'pp_purordnum',
		array(
					'class'=>'CLinkColumn',
                    'header'=>'Numéro du bon de commande',
                    'labelExpression'=>'$data->pp_purordnum',
					//'urlExpression'=>'array("Purchaseorddt/create","pp_purordnum"=>$data->pp_purordnum,)',
                    'urlExpression'=>'$data->pp_status=="Open" ? array("purchaseorddt/create","pp_purordnum"=>$data->pp_purordnum) :
                            array("purchaseorddt/admin","pp_purordnum"=>$data->pp_purordnum)',
        ),
		'pp_date',
		//'cm_supplierid',
        array( 'name'=>'supplier_search', 'value'=>'$data->supplier->cm_orgname' ),

        'pp_requisitionno',
		'pp_payterms',
		'pp_deliverydate',
		//'cm_description',
        'pp_store',
		//'pp_taxrate',
		//'pp_taxamt',
		'pp_currency',
        'pp_exchrate',
		'pp_discrate',
		//'pp_discamt',
		'pp_amount',
		'pp_status',

		array(
			'class'=>'CButtonColumn',
			'header' => 'Acte',
			'template'=>'{update}{delete}{approved}',

            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

			'buttons'=>array
			(
				'update' => array
				(
					'label'=>'update',
					'visible'=>'$data->pp_status=="Open"',
					//'options'=>array('onclick'=>$model->id),
				),   
				
				'delete' => array
				(
					'label'=>'delete',
                    'url'=>
                    'Yii::app()->createUrl("purchaseordhd/delete/",
                                            array("id"=>$data->id, "pp_purordnum"=>$data->pp_purordnum))',
					'visible'=>'$data->pp_status=="Open"',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
					//'options'=>array('onclick'=>$model->id),
				),  

				'approved' => array(
                    'label'=>'Approve',     // text label of the button
                    'url'=>'Yii::app()->createUrl("purchaseordhd/ApproveStatus/", array("id"=>$data->id, "pp_purordnum"=>$data->pp_purordnum))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png',
        			//'visible' => '$data->pp_status=="Open" OR $data->pp_status=="Part Received"',
                    'visible' => '$data->pp_status=="Open"',
				),

			),
		),

        array(
            'class'=>'CButtonColumn',
            'header'=>"Annuler la commance d'Achat ",
            'template'=>'{cancel}',

            'buttons'=>array
            (
                'cancel'=> array
                (
                    'label'=>"Annuler la commande d'Achat",     // text label of the button
                    'url'=>'Yii::app()->createUrl("purchaseordhd/purchaseOrder/", array("id"=>$data->id))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/cancel.png',
                    'visible' => '$data->pp_status=="Open"',
                    'click'=>'function(){return confirm("Purchase Order will be Canceled. Continue ?");}'
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
					'url'=>'Yii::app()->createUrl("sareport/purchaseOrder/", array("pPoNumber"=>$data->pp_purordnum) )',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_pdf.png', 
					'options'=>array('target'=>'_blank'),
				),  
				'toExcel' => array
				(
					'label'=>'toExcel',
					'url'=>'Yii::app()->createUrl("sareport/purchaseOrders/", array("pPoNumber"=>$data->pp_purordnum) )',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_xls.png', 
					'options'=>array('target'=>'_blank'),
				),  
			),
		),
		
	),
)); ?>
</div>