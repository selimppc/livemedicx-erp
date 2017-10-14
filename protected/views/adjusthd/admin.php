<?php
/* @var $this AdjusthdController */
/* @var $model Adjusthd */

$this->breadcrumbs=array(
    'Inventory',
	'Adjustment Header'=>array('admin'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Adjusthd', 'url'=>array('index')),
	array('label'=>'New Adjustment Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}',  'url'=>array('create')),
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
        <b>Manage Stock Adjustment</b>: This screen will allow you to view the overall Stock Adjustment’s detail; you can search specific data by selecting any title columns. By clicking the icons under <b>“Action”</b> column will allow you to update and delete. You can also confirm adjustment by clicking the button <b>“ Confirm Adjustment”</b> under the column <b>” Confirm Adjustment” </b>.

    </div>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'adjusthd-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

        array(
            'class'=>'CLinkColumn',
            'header'=>'Transfer Number',
            'labelExpression'=>'$data->transaction_number',
            //'urlExpression'=>'array("transferdt/create","im_transfernum"=>$data->im_transfernum, "im_status"=>$data->im_status)',
            'urlExpression'=>'$data->STATUS=="Open" ? array("adjustdt/create","transaction_number"=>$data->transaction_number, "branch"=>$data->branch) :
                            array("adjustdt/admin","transaction_number"=>$data->transaction_number)',
        ),
		'DATE',
		'branch',
		//'adjustment_type',
		'confirm_date',

		'currency',
		'exchange_rate',
		'STATUS',
        'inserttime',
        'insertuser',

        array(
            'class'=>'CLinkColumn',
            'header'=>'Voucher No',
            'labelExpression'=>'$data->voucherno',
            'urlExpression'=>'array("sareport/singleVoucher","pVoucherNo"=>$data->voucherno)',
            'linkHtmlOptions'=>array('target'=>'_BLANK'),
        ),

        array(
            'class'=>'CButtonColumn',
            'header'=>'Action',
            'deleteConfirmation'=>"js:'Do you really want to delete this record ?'",
            'template'=>'{update}{delete}',

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

            ),
        ),

        array(
            'class'=>'CButtonColumn',
            'header'=>'Confirm Adjustment',
            //'deleteConfirmation'=>"js:'Do you really want to delete this record ?'",
            'template'=>'{confirm}',

            'buttons'=>array
            (
                'confirm' => array(
                    'label'=>'Confirm Adjustment',     // text label of the button
                    'url'=>'Yii::app()->createUrl("adjusthd/approveAdjustment/", array("id"=>$data->id,
                    "transaction_number"=>$data->transaction_number))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png',
                    'visible' => '$data->STATUS=="Open" ',
                ),

            ),
        ),

        array(
            'class'=>'CButtonColumn',
            'header' => 'Reports',
            'template'=>'{toPDF}{toExcel}',
            'buttons'=>array
            (
                'toPDF' => array
                (
                    'label'=>'toPDF',
                    'url'=>'Yii::app()->createUrl("sareport/adjustment/", array("ptrnnumber"=>$data->transaction_number) )',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_pdf.png',
                    'options'=>array('target'=>'_blank'),
                ),
                'toExcel' => array
                (
                    'label'=>'toExcel',
                    'url'=>'Yii::app()->createUrl("sareport/adjustments/", array("ptrnnumber"=>$data->transaction_number) )',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_xls.png',
                    'options'=>array('target'=>'_blank'),
                ),
            ),
        ),

	),
)); ?>
