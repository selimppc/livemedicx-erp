<?php
/* @var $this JournalController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
    'General Ledger'=>array(''),
	'Receipt Voucher'=>array('adminReceipt'),
	'Create',
);

$this->menu=array(
	array('label'=>'New Receipt Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('createReceipt')),
	array('label'=>'Manage Receipt Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('adminReceipt')),
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
        <b>Entête du Nouveau  Reçu </b>:
        Sur cet écran tous les champs obligatoires doivent être remplis avant de cliquer sur le bouton <b>"Ajouter un nouveau coupon"</b>. Les champs marqués (*) sont obligatoires.  Vous pouvez revenir à  votre écran d'accueil pour afficher les informations sur l'Entête du Reçu en cliquant sur l'onglet du menu  <b>"Gérer l'Entête du Reçu"</b>. Vous pouvez aussi ajouter de nouveaux détails sur un coupon existant en cliquant sur le lien dans la colonne <b>"Numéro du coupon"</b> . ce lien vous  redirigera à la page de détails du coupon.  Les boutons d'action vous permettra de mettre à  jour et de supprimer.


    </div>
</div>

<div style="width: 98%; float: left;">
    <div style="width: 46%; float: left; margin-right: 3%; ">
        <?php $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2, 'offset'=>$offset)); ?>
    </div>
    <div style="width: 51%; float: left; ">

        <h1 style="background: #FFCCFF; padding: 5px; width: 98%; font-weight: bold; text-align: center;">
            Information sur l'Entête du reçu
        </h1>


        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'vouhcerheader-grid',
            'dataProvider'=>$journalvoucher->searchReceiptVoucher(),
            'filter'=>$journalvoucher,
            'columns'=>array(
                array(
                    'class'=>'CLinkColumn',
                    'header'=>'Numero du coupon',
                    'labelExpression'=>'$data->am_vouchernumber',
                    //'urlExpression'=>'array("journaldt/createReceipt", "am_vouchernumber"=>$data->am_vouchernumber )',
                    'urlExpression'=>'$data->am_status!=="Posted" ? array("journaldt/createReceipt","am_vouchernumber"=>$data->am_vouchernumber) :
                            array("journaldt/AdminViewReceipt","am_vouchernumber"=>$data->am_vouchernumber)',
                ),
                'am_date',
                'am_year',
                'am_period',
                'am_branch',
                'am_note',
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
							'url'=>'Yii::app()->createUrl("journal/updateReceipt/",array("id"=>$data->id,))',
                        ),

                        'delete' => array
                        (
                            'label'=>'delete',
                            'visible'=>'$data->am_status!=="Posted"',
                        ),
                    ),
                ),
            ),
        )); ?>

    </div>

</div>

