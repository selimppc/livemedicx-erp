<?php
/* @var $this VouhcerheaderController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
	'Account Payable'=>array('apinvoice'),
	'Invoice',
);

$this->menu=array(
	array('label'=>'Manage A/P Invoice', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('apinvoice')),
);
?>

<style type="text/css">
	table .money-receipt-sales, td, th
	{
		border: 1px solid #4E8EC2;
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
    <div id="flag_desc_text"> <b>Nouvelle facture (de la liste GRN ):</b> Cet écran vous permettra de visualiser l'historique GRN.  Pour faire une facture dans la liste ci-dessous, cliquer sur le bouton  <b>"Faire  une facture"</b> &  dans la colonne <b>"Acte"</b>.  En cliquant sur le bouton <b>"Faire une facture"</b>, un lien apparaîtra dans la colonne <b>"Numéro du coupon GL"</b>. Ce lien vous permettra de visualiser le rapport .  Pour ajouter la TVA cliquer sur le bouton <b>"TVA (%)"</b> dans la colonne "Ajouter TVA", un écran pop-up apparaîtra pour  calculer la TVA (%).
        <br>
        <span style="color: #df8505; font-weight: bold;">
            Warning: this (VAT %) task must perform before creating invoice under action column.
        </span> </div>
</div>




<table style="width: 100%; float: left;">
	<tr> 
		<td style="text-align: center; background: #4085BB; color: white;"> 
			<b> GRN List for Create Invoice </b>
		</td>
	</tr>
</table>


<div style="float: left; width: 99%;">


<?php

    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid-view-id',
	'dataProvider'=>$model->searchInvoice(),
	'filter'=>$model,
	'columns'=>array(

		//'id',
		'im_grnnumber',
		//'cm_supplierid',
        array( 'name'=>'supplier_search', 'value'=>'$data->supplier->cm_orgname' ),

		'im_date',
        //'am_vouchernumber',
        array(
            'class'=>'CLinkColumn',
            'header'=>'Numéro du CouponGL',
            'labelExpression'=>'$data->am_vouchernumber',
            'urlExpression'=>'array("sareport/singleVoucher","pVoucherNo"=>$data->am_vouchernumber)',
            'linkHtmlOptions'=>array('target'=>'_BLANK'),
        ),
		//'pp_requisitionno',
        'im_purordnum',
		'im_payterms',
		'im_amount',
        'im_currency',
		'im_taxamt',

		//'im_discamt',
		'im_netamt',
		'im_status',

		array(
		'class'=>'CButtonColumn',
		'template'=>'{create}',
		'header'=>'Acte',
		'buttons'=>array
            (
				'create' => array
				(
					'label'=>"Créer une Facture",
					'url'=>'Yii::app()->createUrl("vouhcerheader/CreateInvoice/", array("id"=>$data->id))',
					'imageUrl'=>Yii::app()->request->baseUrl.'/images/create.png', 
					'visible' => '$data->im_status !== "Invoiced"',
                ),
			)
		),
        array(
            'class'=>'CButtonColumn',
            'header'=>'Ajouter TVA',
            'template'=>'{VAT}',
            'buttons'=>array(
                'VAT'=>array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/vat.png',
                    'visible' => '$data->im_status !== "Invoiced"',
                    'url'=>'Yii::app()->createUrl("vouhcerheader/saveOnRowModel", array("id"=>$data->id, "im_amount"=>$data->im_amount, "asDialog"=>1))',
                    'options'=>array(
                        'ajax'=>array(
                            'type'=>'POST',
                            // ajax post will use 'url' specified above
                            'url'=>"js:$(this).attr('href')",
                            'update'=>'#id_view',
                        ),
                    ),
                ),
            ),
        ),
	),
));  ?>
</div>




<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'vat',
    'options'=>array(
        'title'=>'Ajouter TVA',
        'width'=> 'auto',
        'height'=>'auto',
        'autoOpen'=>false,
        'resizable'=>true,
        'modal'=>true,
        'closeOnEscape' => true,
        'show'=>array('effect'=>'blur', 'duration'=>500,),
        'hide'=>array('effect'=>'blind', 'duration'=>500,),
    ),
    'htmlOptions' => array(
        'style' => 'font-size: 12px; line-height: 30px;',
    ),

)); ?>


    <div id="id_view"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>