<?php
/* @var $this SmheaderController */
/* @var $model Smheader */

$this->breadcrumbs=array(
    'Sales',
	'Invoice'=>array('smheader/admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'New Invoice', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('invoicehd/create')),
	array('label'=>'Manage Invoice', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('smheader/admin')),
	//array('label'=>'Post to GL', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/post_gl_a.png" /></span>{menu}', 'url'=>array('smheader/postToGl')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Invoice No', 'url'=>array('transaction/manageinvoiceno')),
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
    <div id="flag_desc_text"><b>Manage Invoice:</b> In this screen you can view sales invoice history. To view the item details click on the link under the <b>Sales Number</b> column. For  Cancel or Confirm  Click the button under the column  <b>"Cancel Invoice"</b> or <b>"Confirm Invoice"</b>. Under <b>Reports</b> column select pdf or xls for viewing report. After confirming the invoice, a link will appear under the column <b>"GL Voucher No"</b> for viewing reports. To create new invoice click on the menu tab <b>"New Invoice"</b>, this will redirect you to new entry screen.
    </div>
</div>

<h1></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sm-header-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'sm_number',
			array(
				'class'=>'CLinkColumn',
            	'header'=>'Sales Number',
            	'labelExpression'=>'$data->sm_number',
                'urlExpression'=>'$data->sm_stataus=="Open" ? array("invoicedt/create","sm_number"=>$data->sm_number, "sm_date"=>$data->sm_date, "sm_storeid"=>$data->sm_storeid ) : array("invoicedt/admin","sm_number"=>$data->sm_number)',
            ),
		'sm_date',
        array( 'name'=>'customer_search', 'value'=>'$data->customer->cm_name' ),
		//'sm_sp',
		'sm_storeid',
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
		//'sm_sign',
		'sm_stataus',
        'inserttime',
        'insertuser',
        array(
            'class'=>'CLinkColumn',
            'header'=>'GL Voucher No',
            'labelExpression'=>'$data->glvoucher',
            'urlExpression'=>'array("../reports/single_voucher.php?pVoucherNo=$data->glvoucher")',
            
            'linkHtmlOptions'=>array('target'=>'_BLANK'),
        ),

		array(
            'class'=>'CButtonColumn',
			'header'=>'Cancel Invoice',
            'template'=>'{cancel}',

            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

            'buttons'=>array
            (
                'cancel'=> array
                (
                    'label'=>'Cancel Invoice',     // text label of the button
                    'url'=>'Yii::app()->createUrl("smheader/cancelInvoice/", array("id"=>$data->id))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/cancel.png',
        			'visible' => '$data->sm_stataus=="Open"',
                    'click'=>'function(){return confirm("Invoice will be Canceled. Continue ?");}'
                ),

            ),
        ),

        array(
            'class'=>'CButtonColumn',
            'header'=>'Confirm Invoice',
            'template'=>'{confirm}',

            'buttons'=>array
            (
                'confirm'=> array
                (
                    'label'=>'Confirm Invoice',     // text label of the button
                    'url'=>'Yii::app()->createUrl("smheader/approveStatus", array("id"=>$data->id,"sm_number"=>$data->sm_number ))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/approved.png',
                    'visible' => '$data->sm_stataus=="Open"',
                ),
            ),
        ),

        array(
            'class'=>'CButtonColumn',
            'header' => 'Reports',
            'template'=>'{See Reports}',
            'buttons'=>array
            (
                'See Reports' => array
                (
                    'label'=>'See Reports',
                    'url'=>'Yii::app()->createUrl("../reports/sales_report_invoice.php?psmnumber=$data->sm_number" )',
                    'See Reports',
                    'options'=>array('target'=>'_blank'),
                ),
                
            ),
        ),

	),



)); ?>
