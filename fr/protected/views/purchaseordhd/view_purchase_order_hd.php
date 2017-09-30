<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(
	'GRN'=>array('purchaseordhd/ViewPurchaseOrderHd'),
	'Create GRN from Purchase Order',
);

$this->menu=array(
	//array('label'=>'List Productmaster', 'url'=>array('index')),
	array('label'=>'BR Histoire ', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/grn_a.png" /></span>{menu}', 'url'=>array('purchaseordhd/ViewPurchaseOrderHd')),
	array('label'=>'Manage BR', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('purchaseordhd/ViewGrn')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'GRN Number', 'url'=>array('transaction/ManageGRNnumnber')),

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
    <div id="flag_desc_text"><b>Créer  un Accusé de Réception (AR) à partir de la commande d'achat: </b>
        Sur cet écran vous serez en mesure de visualiser toute l'historique de la commande d'achat pour créer  un AR.  Pour créer un nouveau AR, cliquer sur le bouton  <b>"Créer un AR"</b> dans la colonne  <b>"Acte"</b> .Vous pouvez également consulter les rapports en cliquant sur le lien dans la colonne <b>"Numéro de la demande d'achat"</b>. Pour afficher l'historique GRN avec des détails, cliquer sur l'onglet du menu <b>"Gérer un AR"</b>.
    </div>
</div>


<br>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	
	'columns'=>array(
		//'id',
		//'pp_purordnum',
        array(
            'class'=>'CLinkColumn',
            'header'=>"Numéro de  la commande d'achat",
            'labelExpression'=>'$data->pp_purordnum',
            'urlExpression'=>'array("sareport/singlePoGrn","pPoNumber"=>$data->pp_purordnum)',
            'linkHtmlOptions'=>array('target'=>'_BLANK'),
        ),
		'cm_supplierid',
		'cm_orgname',
		'Order_Date',
		'Delivery_Date',
		'pp_status',

    	
        array(
            'class'=>'CButtonColumn',
        	'header' => 'Acte',
			'template' => '{GRN}',
			
			'buttons' => array(
                   'GRN' => array(
                    'label'=>'Create GRN',     // text label of the button
                    'url'=>'Yii::app()->createUrl("purchaseordhd/CreateGRN/", array("id"=>$data->id))', 
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/create.png', 
        			'visible' => '$data->pp_status=="Approved" OR $data->pp_status=="Part Received"',
					),
             
        	),
	),
))); ?>
