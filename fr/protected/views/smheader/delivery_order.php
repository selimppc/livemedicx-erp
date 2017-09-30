<?php
/* @var $this SmheaderController */
/* @var $model Smheader */

$this->breadcrumbs=array(
    'Inventory',
	'Delivery Order'=>array('smheader/deliveryOrder'),


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
    <div id="flag_desc_text"><b>Réception du Stock:</b> Sur cet écran vous serez en mesure de confirmer la livraison en cliquant sur le bouton sous la  colonne <b>"Confirmer "</b> de la colonne <b>" Confirmer la livraison"</b>. Vous pouvez également afficher une information complète en cliquant sur le bouton dans la colonne <b>"Visualiser une information complète"</b> .
    </div>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sm-header-grid',
	'dataProvider'=>$model->deliveryOrder(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'sm_number',
			array(
					'class'=>'CLinkColumn',
                    'header'=>'Numéros des ventes',
                    'labelExpression'=>'$data->sm_number',
                    'urlExpression'=>'array("batchsale/admin","sm_number"=>$data->sm_number)',
                ),
		'sm_date',
         array( 'name'=>'customer_search', 'value'=>'$data->customer->cm_name' ),
		//'sm_sp',
		//'sm_doc_type',
		//'sm_territory',
		//'sm_rsm',
		//'sm_area',
		'sm_payterms',
		'sm_totalamt',
		'sm_total_tax_amt',
		//'sm_disc_rate',
		'sm_disc_amt',
		'sm_netamt',
        //'imvoucher',
		//'sm_sign',
		'sm_stataus',
		//'sm_refe_code',

        array(
            'class'=>'CLinkColumn',
            'header'=>'Numéro du coupon',
            'labelExpression'=>'$data->imvoucher',
            'urlExpression'=>'array("sareport/singleVoucher","pVoucherNo"=>$data->imvoucher)',
            'linkHtmlOptions'=>array('target'=>'_BLANK'),
        ),

		array(
            'class'=>'CButtonColumn',
			'header'=>'Confirmer la livraison',
            'template'=>'{confirm}',
            'buttons'=>array
            (
            	/*
            	'update'=> array
                (
                    'label'=>'update',     // text label of the button
                    //'url'=>'Yii::app()->createUrl("smheader/ApproveStatus/", array("id"=>$data->id))', 
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png', 
        			'visible' => '$data->sm_stataus=="Open" OR $data->sm_stataus=="Delivered"',
                ),
                'delete'=> array
                (
                    'label'=>'delete',     // text label of the button
                    //'url'=>'Yii::app()->createUrl("smheader/ApproveStatus/", array("id"=>$data->id))', 
                    //'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png', 
        			'visible' => '$data->sm_stataus=="Open" OR $data->sm_stataus=="Delivered"',
                ), */
                'confirm'=> array
                (
                    'label'=>'Confirmer la livraison',     // text label of the button
                    'url'=>'Yii::app()->createUrl("smheader/OrdDeliverd/", array("id"=>$data->id))', 
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png', 
        			'visible' => '$data->sm_stataus !=="Delivered"',
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
                    'url'=>'Yii::app()->createUrl("sareport/deliveryOrderChallan/", array("psmnumber"=>$data->sm_number) )',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_pdf.png',
                    'options'=>array('target'=>'_blank'),
                ),
                'toExcel' => array
                (
                    'label'=>'toExcel',
                    'url'=>'Yii::app()->createUrl("sareport/deliveryOrderChallans/", array("psmnumber"=>$data->sm_number) )',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_xls.png',
                    'options'=>array('target'=>'_blank'),
                ),
            ),
        ),

	),
)); ?>
