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
    <div id="flag_desc_text"> <b>New Invoice (from GRN list):</b> This screen will allow you to view the GRN history. To create invoice from the list below click the <b>"Create Invoice"</b> button under <b>Action</b> column. By clicking <b>"Create Invoice"</b> button a link will appear under <b>"GL Voucher No"</b> column. This link will allow you to view the report(s). To add VAT, click on the button <b>"VAT(%)"</b> under the column <b>Add VAT</b>, a pop-up screen will appear for  VAT(%) calculation.
        <br>
        <span style="color: #df8505; font-weight: bold;"> Warning: this (VAT %) task must perform before creating invoice under action column.</span> </div>
</div>




<table style="width: 100%; float: left;">
    <tr> 
        <td style="text-align: center; background: #4085BB; color: white;"> 
            <b> GRN List for Create Invoice </b>
        </td>
    </tr>
</table>


<div style="float: left; width: 99%;" id="majed">


<?php

    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'grid-view-id',
    'dataProvider'=>$model->searchInvoice(),
    'filter'=>$model,
    'columns'=>array(

        //'id',
        'im_grnnumber',
        'cm_supplierid',
        array( 'header'=>'Supplier Name','value'=>'$data->supplier->cm_orgname' ),

        'im_date',
        //'am_vouchernumber',
		
        array(
            'class'=>'CLinkColumn',
            'header'=>'GL Voucher No',
            'labelExpression'=>'$data->am_vouchernumber',
            'urlExpression'=>'array("../reports/ap_invoice.php?pVoucherNo=$data->am_vouchernumber")',
            'linkHtmlOptions'=>array('target'=>'_BLANK'),
        ),
        //'pp_requisitionno',
        'im_purordnum',
        'im_payterms',
        'im_amount',
        'im_currency',
        

        'im_discamt',
        'im_taxamt',
        'im_netamt',
        'im_status',
        'inserttime',
        'insertuser',

        
        array(
            'class'=>'CButtonColumn',
            'header'=>'Add Discount',
            'template'=>'{Discount}',
            'buttons'=>array(
                'Discount'=>array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/discount.png',
                    'visible' => '$data->im_distype ==0',
                    'url'=>'Yii::app()->createUrl("vouhcerheader/Savediscount", array("id"=>$data->id, "im_amount"=>$data->im_amount, "asDialog"=>1))',
                    'options'=>array(
                        'ajax'=>array(
                            'type'=>'POST',
                            // ajax post will use 'url' specified above
                            'url'=>"js:$(this).attr('href')",
                            'update'=>'#id_dis',
                        ),
                    ),
                ),
            ),
        ),
            array(
            'class'=>'CButtonColumn',
            'header'=>'Add VAT',
            'template'=>'{VAT}',
            'buttons'=>array(
                'VAT'=>array(
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/vat.png',
                    'visible' => '$data->im_status !== "Invoiced"',
                    'url'=>'Yii::app()->createUrl("vouhcerheader/saveOnRowModel", array("id"=>$data->id, "im_netamt"=>$data->im_netamt, "asDialog"=>1))',
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
        'template'=>'{create}',
        'header'=>'Action',
        'buttons'=>array
            (
                'create' => array
                (
                    'label'=>'Create Invoice', 
                    'url'=>'Yii::app()->createUrl("vouhcerheader/CreateInvoice/", array("id"=>$data->id))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/create.png', 
                    'visible' => '$data->im_status !== "Invoiced"',
                ),
            )
        ),
        
    ),
));  ?>
</div>


<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'vat',
    'options'=>array(
        'title'=>'Add VAT',
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

));
 ?>
 <div id="id_view"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'dis',
    'options'=>array(
        'title'=>'Add Discount',
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


    <div id="id_dis"></div>

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>