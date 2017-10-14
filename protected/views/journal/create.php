<?php
/* @var $this JournalController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
    'General Ledger',
	'Journal Voucher'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'New Voucher Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'Manage Voucher Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
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
        <b>New Voucher Header</b>: In this screen, all of the required fields need to be filled before clicking the button <b>“Add New Voucher”</b>. Fields marked with (*) are mandatory. You can go back to your homescreen to view Voucher Header’s information by clicking the menu tab <b>“Manage Voucher Header”</b>. Also you can add new voucher details on existing Voucher by clicking the link under <b> “Voucher Number” </b> column; this link will redirect you to voucher detail page. <b>Action</b> buttons will allow you to update and delete.
</div>
</div>

<div style="width: 98%; float: left;">
    <div style="width: 46%; float: left; margin-right: 3%; ">
        <?php $this->renderPartial('_form', array('model'=>$model,'model2'=>$model2, 'offset'=>$offset)); ?>
    </div>
    <div style="width: 51%; float: left; ">

        <h1 style="background: #FFCCFF; padding: 5px; width: 98%; font-weight: bold; text-align: center;">
           Voucher Header Information
        </h1>


        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'vouhcerheader-grid',
            'dataProvider'=>$journalvoucher->searchJournalVoucher(),
            'filter'=>$journalvoucher,
            'columns'=>array(
                array(
                    'class'=>'CLinkColumn',
                    'header'=>'Voucher Number',
                    'labelExpression'=>'$data->am_vouchernumber',
                    //'urlExpression'=>'array("journaldt/create", "am_vouchernumber"=>$data->am_vouchernumber )',
                    'urlExpression'=>'$data->am_status!=="Posted" ? array("journaldt/create","am_vouchernumber"=>$data->am_vouchernumber) :
                            array("journaldt/adminView","am_vouchernumber"=>$data->am_vouchernumber)',
                ),
                'am_date',
                'am_year',
                'am_period',
                'am_branch',
                'am_note',
                array(
                    'class'=>'CButtonColumn',
                    'header'=>'Action',
                    'template'=>'{update}{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',


                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'label'=>'update',
                            'visible'=>'$data->am_status!=="Posted"',
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

