<?php
/* @var $this JournalController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
    'General Ledger',
    'Journal Voucher'=>array('admin'),
);

$this->menu=array(
	//array('label'=>'List Vouhcerheader', 'url'=>array('index')),
	array('label'=>'New Voucher Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
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
        <b>Manage Journal Voucher</b>: This screen will allow you to view the overall Journal Voucher’s detail; you can search specific data by selecting any title columns. By clicking the icons under <b>“Action”</b> column will allow you to update and delete. You can also open a data entry screen to input new Journal Voucher’s Information by clicking the Menu tab <b>“New Journal Voucher”</b>.  Also you can view the reports by clicking the icon of pdf or xls under the <b>”Reports”</b> column.
 </div>
</div>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'vouhcerheader-grid',
	'dataProvider'=>$model->searchJournalVoucher(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'am_vouchernumber',
        array(
            'class'=>'CLinkColumn',
            'header'=>'Voucher Number',
            'labelExpression'=>'$data->am_vouchernumber',
            //'urlExpression'=>'array("journaldt/create", "am_vouchernumber"=>$data->am_vouchernumber )',
            'urlExpression'=>'$data->am_status!=="Posted" ? array("journaldt/create","am_vouchernumber"=>$data->am_vouchernumber) :
                            array("journaldt/adminView","am_vouchernumber"=>$data->am_vouchernumber)',
        ),
		'am_date',
		'am_referance',
		'am_year',
		'am_period',
		'am_branch',
		'am_note',
		'am_status',
        'inserttime',
        'insertuser',
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

        array(
            'class'=>'CButtonColumn',
            'header' => 'Reports',
            'template'=>'{toPDF}{toExcel}',
            'buttons'=>array
            (
                'toPDF' => array
                (
                    'label'=>'toPDF',
                    'url'=>'Yii::app()->createUrl("sareport/singleVoucher/", array("pVoucherNo"=>$data->am_vouchernumber) )',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_pdf.png',
                    'options'=>array('target'=>'_blank'),
                ),
                'toExcel' => array
                (
                    'label'=>'toExcel',
                    'url'=>'Yii::app()->createUrl("sareport/singleVoucher/", array("pVoucherNo"=>$data->am_vouchernumber) )',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/action_btn_xls.png',
                    'options'=>array('target'=>'_blank'),
                ),
            ),
        ),
	),
)); ?>
