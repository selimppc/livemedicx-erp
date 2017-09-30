<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(
    'Inventory',
	'GRN'=>array('purchaseordhd/ViewPurchaseOrderHd'),
	'Manage BR',
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
    <div id="flag_desc_text">
        <b>AR  </b>: Cet écran vous permettra de visualiser l'ensemble des détails de l'AR;  vous pouvez rechercher les données spécifiques en sélectionnant n'importe quel  titre des colonnes. Vous pouvez aussi confirmer l'AR en cliquant sur le bouton <b>"Confirmer"</b> de la colonne <b>"Acte"</b> . Et vous pouvez aller à la page des détails pour chaque BR en cliquant sur le lien de la colonne <b>"Numéro de l'AR"</b> . Le lien vous redirigera  à la page des détailspour visualiser ou ajouter de nouveaux détails.Pour visualiser l'historique des AR, cliquer sur l'ongletdu menu <b>"Historique des AR"</b>.

    </div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	
	'columns'=>array(
		//'im_grnnumber',
		array(
			'class'=>'CLinkColumn',
            'header'=>"Numéro de l'AR",
            'labelExpression'=>'$data->im_grnnumber',
            //'urlExpression'=>'Yii::app()->createUrl("Purchaseorddt/PurchaseOrderNumberS1", array("pp_purordnum"=>$data->pp_purordnum))',
			//'urlExpression'=>'array("grndetail/create", "pp_purordnum"=>$data->im_purordnum, "vGrnNumber"=>$data->im_grnnumber )',
			'urlExpression'=>'$data->im_status=="Open" ? array("grndetail/create", 
			"pp_purordnum"=>$data->im_purordnum, "vGrnNumber"=>$data->im_grnnumber ) : array("grndetail/grnDetailAdmin", 
			"im_grnnumber"=>$data->im_grnnumber, "im_purordnum"=>$data->im_purordnum, "im_date"=>$data->im_date, 
			"cm_orgname"=>$data->cm_orgname) ',
			//'urlExpression'=>'array("grndetail/admin","im_grnnumber"=>$data->im_grnnumber, "im_purordnum"=>$data->im_purordnum )',
			//'linkHtmlOptions'=>array('target'=>'_blank'),  
        ),
		'im_purordnum',
		'im_date',
		//'cm_supplierid',
        'cm_orgname',
        array(
            'header'=>'Branch',
            'name'=>'im_store',
            'value'=>'$data->im_store',
        ),
		'im_status',
        
         array(
            'class'=>'CButtonColumn',
         	'header' => 'Acte',
			'template' => '{GRN}',
			
			'buttons' => array(
                   'GRN' => array(
                    'label'=>'Confirm GRN',     // text label of the button
                    'url'=>'Yii::app()->createUrl("purchaseordhd/ConfirmGRN/", array("id"=>$data->id, "im_grnnumber"=>$data->im_grnnumber))', 
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/create.png', 
        			'visible' => '$data->im_status=="Approved" OR $data->im_status=="Open"',
					),
             
        	),
	),

))); ?>
