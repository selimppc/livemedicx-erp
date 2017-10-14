<?php
/* @var $this AdjusthdController */
/* @var $model Adjusthd */

$this->breadcrumbs=array(
    'Inventory',
	'Stock Adjustment'=>array('admin'),
	'New Stock Adjustment Header',
);

$this->menu=array(
	array('label'=>'Manage Stock Adjustment', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}',  'url'=>array('admin')),
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
        <b>Ajustement du nouveau stock</b>: Sur cet écran tous les champs obligatoires doivent être remplis avant de cliquer sur le bouton <b>"Ajouter l'en-tête  d'un ajustement "</b>. Les champs marqués (*) sont obligatoires.  Vous pouvez revenir à  votre écran d'accueil pour afficher des informations sur  l' en-tête  de l'ajustement  en cliquant sur l'onglet du menu <b>" Gérer l' en-tête  d'un ajustement"</b>. Vous pouvez aussi ajouter des détails d'un  nouveau coupon sur un transfert existant en cliquant sur le lien dans la colonne <b>" Numéro du transfert"</b>. Ce lien vous redirigera à la page des détails de l'ajustement .  Les boutons d'action vous permettra de mettre à  jour et de supprimer.
    </div>
</div>

<div style="width: 99%; float: left;">
    <div style="width: 47%; float: left; margin-right: 3%;">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>

    <div style="width: 50%; float: left;">

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'adjusthd-grid',
            'dataProvider'=>$adjustmentHd->search(),
            'filter'=>$adjustmentHd,
            'columns'=>array(
                //'id',
                //'transaction_number',
                array(
                    'class'=>'CLinkColumn',
                    'header'=>'Numéro du transfert',
                    'labelExpression'=>'$data->transaction_number',
                    'urlExpression'=>'$data->STATUS=="Open" ? array("adjustdt/create","transaction_number"=>$data->transaction_number, "branch"=>$data->branch) :
                            array("adjustdt/admin","transaction_number"=>$data->transaction_number)',
                ),
                'DATE',
                'branch',
                //'adjustment_type',
                //'confirm_date',

                'currency',
                'exchange_rate',
                //'STATUS',

                array(
                    'class'=>'CButtonColumn',
                    'header'=>'Acte',
                    'deleteConfirmation'=>"js:'Do you really want to delete this record ?'",
                    'template'=>'{update}{delete}{confirm}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'label'=>'update',
                            'visible'=>'$data->STATUS=="Open"',
                            //'options'=>array('onclick'=>$model->id),
                        ),

                        'delete' => array
                        (
                            'label'=>'delete',
                            'visible'=>'$data->STATUS=="Open"',
                            //'options'=>array('onclick'=>$model->id),
                        ),

                        'confirm' => array(
                            'label'=>'Ajustement de la confirmation',     // text label of the button
                            'url'=>'Yii::app()->createUrl("adjusthd/ConfirmStatus/", array("id"=>$data->id))',
                            'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png',
                            'visible' => '$data->STATUS=="Open" ',
                        ),

                    ),
                ),
            ),
        )); ?>
    </div>
</div>
