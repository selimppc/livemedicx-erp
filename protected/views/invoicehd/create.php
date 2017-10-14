<?php
/* @var $this InvoicehdController */
/* @var $model Smheader */

$this->breadcrumbs=array(
    'Sales',
	'Invoice'=>array('smheader/admin'),
	'New Invoice header',
);

$this->menu=array(
    array('label'=>'<< Back to Manage Invoice', 'url'=>array('smheader/admin')),
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
        <div id="flag_desc_text"><b>New Invoice:</b> In this screen fill up the fields in both tables. Please follow the <b style="color: #008000;">Instruction</b> below ** on column <b>Item Details</b>.</div>
    </div>




<div style="width: 98%; float: left;">
    <div style="width: 46%; float:left; margin-right: 3%;">

        <h1 style="background: #d3d3d3; padding: 7px; width: 86%;font-weight: bold; text-align: center;">
            Enter Invoice Header Information
        </h1>

        <?php $this->renderPartial('_form', array('model'=>$model)); ?>

    </div>

    <div style="width: 51%; float: left;">

        <h1 style="background: #d3d3d3; padding: 7px; width: 97%;font-weight: bold; text-align: center;">
            Maintenance Invoices
        </h1>

            <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'purchaseordhd-grid',
            'dataProvider'=>$adminview->search(),
            'filter'=>$adminview,
            'columns'=>array(
                //'id',
                //'sm_number',
                array(
                    'class'=>'CLinkColumn',
                    'header'=>'Invoice Number',
                    'labelExpression'=>'$data->sm_number',
                    'urlExpression'=>'$data->sm_stataus=="Open" ? array("invoicedt/create","sm_number"=>$data->sm_number, "sm_date"=>$data->sm_date, "sm_storeid"=>$data->sm_storeid ) : array("invoicedt/admin","sm_number"=>$data->sm_number)',
                ),

                'sm_date',
                array( 'name'=>'customer_search', 'value'=>'$data->customer->cm_name' ),
                'sm_totalamt',
                'sm_total_tax_amt',
                'sm_disc_amt',
                'sm_netamt',


                array(
                    'class'=>'CButtonColumn',
                    'header' => 'Action',
                    'template'=>'{update}{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'label'=>'update',
                            'visible'=>'$data->sm_stataus=="Open"',
                            //'options'=>array('onclick'=>$model->id),
                        ),

                        'delete' => array
                        (
                            'label'=>'delete',
                            'url'=>
                                'Yii::app()->createUrl("invoicehd/delete/",
                                                    array("id"=>$data->id, "sm_number"=>$data->sm_number))',
                            'visible'=>'$data->sm_stataus=="Open"',
                            'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                            //'options'=>array('onclick'=>$model->id),
                        ),

                    ),
                ),

            ),
        )); ?>
    </div>
</div>
