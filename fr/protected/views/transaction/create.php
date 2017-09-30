<!--Generated using Gimme CRUD freeware from www.HandsOnCoding.net -->
<?php
$this->breadcrumbs=array(
    'Purchase Module',
    'Settings'=>array('transaction/purchaseSettings'),
	'New Requisition Number',
);

$this->menu=array(
    array('label'=>'<< Back to Settings', 'url'=>array('transaction/purchaseSettings')),
	array('label'=>'New Requisition Number', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('transaction/create')),
    //array('label'=>'Manage Requisition Number', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('transaction/ManageRequisitionNum')),
		/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Requisition Number', 'url'=>array('transaction/ManageRequisitionNum')),
	),
	),	*/
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
    <div id="flag_desc_text">Sur cet écran, vous devez compléter tous les champs avant de cliquer sur le bouton <b>"Entrer le numéro de demande"</b>, les détails de la demande ont été fait dans le tableau de gauche ,sous Détails sur le numéro de la demande. Vous pouvez retourner aux configurations pour regarder tous les outils de configuration d'une commande en cliquant sur le lien du menu  <b>"Retour aux configurations"</b>
    </div>
</div>


<div style="width: 98%; float: left;">
    <div style="width: 46%; margin-right: 3%; float: left;">
        <h1 style="background: #d3d3d3; padding: 7px; width: 85%; font-weight: bold;">
            Enter Requisition Information
        </h1>

        <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
    <div style="width: 50%; float: left;">
        <h1 style="background: #d3d3d3; padding: 7px; width: 85%; font-weight: bold;">
            Requisition NO list
        </h1>
        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'class-grid',
            'dataProvider'=>$requisition,
            //'filter'=>$requisition,

            'columns'=>array(
                'cm_type',
                'cm_trncode',
                'cm_branch',
                'cm_lastnumber',
                //'cm_increment',
                //'cm_active',
				/*
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{update}{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',


                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'url'=>
                            'Yii::app()->createUrl("transaction/UpdateRequisitionNumber/",
                                                    array("cm_type"=>$data->cm_type, "cm_trncode"=>$data->cm_trncode
                                                    ))',
                        ),
                        'delete'=> array
                        (
                            'url'=>
                            'Yii::app()->createUrl("transaction/delete/",
                                                    array("cm_type"=>$data->cm_type, "cm_trncode"=>$data->cm_trncode
                                                    ))',
                        ),
                    ),
                ),*/

            ))); ?>
    </div>
</div>