<?php
/* @var $this PurchaseordhdController */
/* @var $model Purchaseordhd */

$this->breadcrumbs=array(
	'Purchase'=>array('admin'),
	'New Purchase Order Header',
);

$this->menu=array(
    array('label'=>'New Purchase Order Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'Manage Purchase Order', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
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
        <b> Nouvelle demande d'Achat </b>: Sur cet écran tous les champs obligatoires doivent être Complétés avant de cliquer sur le bouton <b>"Ajouter l'en-tête de la demande d'Achat "</b>. Les champs marqués (*) sont obligatoires.  Vous pouvez revenir à  votre écran d'accueil pour afficher les informations sur l'entête de la demande en cliquant sur l'onglet <b>" Gérer  commande d'Achat"</b> du menu. Vous pouvez aussi ajouter des  détails du nouveau coupon sur un bon existant en cliquant sur le lien dans la colonne  <b>"Numéro de la demande commande d'Achat" </b>. ce lien vous redirigera à la page des détails du coupon.  Les boutons d'action vous permettra de mettre à  jour et de supprimer.

    </div>
</div>


<div style="width: 98%; float: left;">
    <div style="width: 46%; float:left; margin-right: 3%;">

        <h1 style="background: #d3d3d3; padding: 7px; width: 86%;font-weight: bold;">
            Entrer les informations sur la Commande d'Achat
        </h1>

        <?php $this->renderPartial('_form', array('model'=>$model)); ?>

    </div>

    <div style="width: 51%; float: left;">

        <h1 style="background: #d3d3d3; padding: 7px; width: 97%;font-weight: bold;">
            Vérifierla commande d'Achat
        </h1>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'purchaseordhd-grid',
            'dataProvider'=>$adminview->search(),
            'filter'=>$adminview,
            'columns'=>array(
                // 'id',
                //'pp_purordnum',
                array(
                    'class'=>'CLinkColumn',
                    'header'=>"Numéro de la Commande d'Achat",
                    'labelExpression'=>'$data->pp_purordnum',
                    //'urlExpression'=>'array("purchaseorddt/create","pp_purordnum"=>$data->pp_purordnum )',
                    'urlExpression'=>'$data->pp_status=="Open" ? array("purchaseorddt/create","pp_purordnum"=>$data->pp_purordnum) :
                            array("purchaseorddt/admin","pp_purordnum"=>$data->pp_purordnum)',
                ),

                array( 'name'=>'supplier_search', 'value'=>'$data->supplier->cm_orgname' ),
                //'pp_deliverydate',
                'pp_store',
                'pp_currency',
                'pp_exchrate',
                'pp_discrate',


                array(
                    'class'=>'CButtonColumn',
                    'header' => 'Acte',
                    'template'=>'{update}{delete}',

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

                    ),
                ),

            ),
        )); ?>
    </div>
</div>
