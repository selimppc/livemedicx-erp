<?php
/* @var $this SmheaderController */
/* @var $model Smheader */

$this->breadcrumbs=array(
    'Sales',
    'Manage Money Receipt'=>array('smheader/adminmoneyreceipt'),
    'Money Receipt',
);

$this->menu=array(
    array('label'=>'<< Back to Money Receipt',  'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('smheader/adminmoneyreceipt')),
    /*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
        'items'=>array(
                array('label'=>'Sales Return No', 'url'=>array('transaction/managesalesreturnno')),
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
    <div id="flag_desc_text"><b>Gérer la réception d'argent :</b>
        Sur cet écran vous pouvez  visualiser  toute la  liste des  reçus d'argent . Pour afficher l'attribution des factures, cliquer sur le lien dans la colonne <b>"Visualiser l'attribution des factures"</b>.  Pour Annuler ou Confirmer, Cliquer sur le bouton dans la colonne <b>"Annuler la réception"</b> ou <b>"Confirmer la réception"</b>.  Sous la rubrique <b>"Rapports"</b> , sélectionner  pdf ou xls pour visualiser le rapport.  Après confirmation de la facture un lien apparaîtra dans la colonne <b>"Numéro du Coupon"</b> pour regarder les rapports.  Pour créer une nouvelle facture cliquez sur l'onglet du menu  <b>"Nouvelle facture"</b>. cela va vous rediriger vers nouvel écran d'entrée.
    </div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'sm-header-grid',
    'dataProvider'=>$model->searchMoneyReceipt(),
    'filter'=>$model,
    'columns'=>array(
        //'id',
        //'sm_number',
        array('name'=>'sm_number','header'=>"Réception d'argent", 'value'=>'$data->sm_number' ),
        'sm_date',
        'cm_cuscode', //with customer name
        array( 'name'=>'customer_search', 'value'=>'$data->customer->cm_name' ),
        //'sm_sp',
        //'sm_doc_type',
        //'sm_territory',
        //'sm_rsm',
        //'sm_area',
        //'sm_payterms',
        //'sm_totalamt',
        //'sm_total_tax_amt',
        //'sm_disc_rate',
        //'sm_disc_amt',
        'sm_netamt',
        //'sm_sign',
        'sm_stataus',
        array(
            'class'=>'CLinkColumn',
            'header'=>'Numéro du coupon',
            'labelExpression'=>'$data->glvoucher',
            'urlExpression'=>'array("sareport/singleVoucher","pVoucherNo"=>$data->glvoucher)',
            'linkHtmlOptions'=>array('target'=>'_BLANK'),
        ),

        array(
            'class'=>'CButtonColumn',
            'header'=>'Visualiser la facture',
            'template'=>'{view}',
            'buttons'=>array(
                'view'=>array(
                    'url'=>'Yii::app()->createUrl("smheader/AdminMrAlc", array("sm_number"=>$data->sm_number,"asDialog"=>1))',
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

        array(
            'class'=>'CButtonColumn',
            'header'=>'Annuler la réception',
            'template'=>'{cancel}',

            'buttons'=>array
            (
                'cancel'=> array
                (
                    'label'=>"Annuler la réception",     // text label of the button
                    'url'=>'Yii::app()->createUrl("smheader/cancelMoneyReceipt/", array("id"=>$data->id,"sm_number"=>$data->sm_number))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/cancel.png',
                    'visible' => '$data->sm_stataus=="Open"',
                    'click'=>'function(){return confirm("Money Receipt will be Canceled. Continue ?");}'
                ),

            ),
        ),


        array(
            'class'=>'CButtonColumn',
            'header' => "Confirmer la réception d'argent",
            'template'=>'{approved}',

            'buttons'=>array
            (
                'approved' => array(
                    'label'=>"Confirmer la réception d'argent",     // text label of the button
                    'url'=>'Yii::app()->createUrl("smheader/approveMr/", array("id"=>$data->id))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png',
                    'visible' => '$data->sm_stataus=="Open"',
                ),

            ),
        ),
    ),
)); ?>



<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'manage_money_receipt',
    'options'=>array(
        'title'=>'Allocated Invoice',
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