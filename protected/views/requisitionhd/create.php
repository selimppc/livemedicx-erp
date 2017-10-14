<?php
/* @var $this RequisitionhdController */
/* @var $model Requisitionhd */

$this->breadcrumbs=array(
	'Requisition'=>array('admin'),
	'New Requisition Header ',
);

$this->menu=array(
    array('label'=>'New Requisition Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	array('label'=>'Manage Requisition Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
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
        <b>New Requisition Header </b>: In this screen, all of the required fields need to be filled before clicking the button <b>“Add Requisition Header”</b>. Fields marked with (*) are mandatory. You can go back to your homescreen to view Requisition Header’s information by clicking the menu tab <b>“Manage Requisition Header”</b>. Also you can add new voucher details on existing Voucher by clicking the link under <b> “Requisition Number” </b> column; this link will redirect you to voucher detail page. <b>Action</b> buttons will allow you to update and delete.
    </div>
</div>

<div style="width: 98%; float: left;">
    <div style="width: 46%; float:left; margin-right: 3%;">

        <h1 style="background: #FFCCFF; padding: 7px; width: 86%;font-weight: bold; text-align: center;">
            Enter Requisition Header Information
        </h1>

        <?php $this->renderPartial('_form', array('model'=>$model)); ?>

    </div>
    <div style="width: 51%; float: left;">

        <h1 style="background: #FFCCFF; padding: 7px; width: 97%;font-weight: bold; text-align: center;">
            Maintenance Requisition Header
        </h1>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'requisitionhd-grid',
            'dataProvider'=>$requisitionSearch->search(),
            'filter'=>$requisitionSearch,
            'columns'=>array(
                //'id',
                //'pp_requisitionno',
                array(
                    'class'=>'CLinkColumn',
                    'header'=>'Requisition Number',
                    'labelExpression'=>'$data->pp_requisitionno',
                    'urlExpression'=>'$data->pp_status!=="PO Created" ? array("requisitiondt/create","pp_requisitionno"=>$data->pp_requisitionno) :
                            array("requisitiondt/admin","pp_requisitionno"=>$data->pp_requisitionno)',
                ),
                //'cm_supplierid',
                //'cm_orgname',
                array( 'name'=>'supplier_search', 'value'=>'isset($data->supplier->cm_orgname)?$data->supplier->cm_orgname:""' ),
                'pp_date',
                //'pp_branch',
                'pp_currency',
                'pp_exchrate',
                'pp_branch',
                //'pp_note',
                //'pp_status',

                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{update}{delete}',
                    'header' => 'Action',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                    'buttons'=> array(

                        'update' => array(
                            'visible' => '$data->pp_status!=="PO Created"',
                        ),

                        'delete' => array(
                            'url'=>
                            'Yii::app()->createUrl("requisitionhd/delete/",
                                                    array("id"=>$data->id, "pp_requisitionno"=>$data->pp_requisitionno))',
                            'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
                            'visible' => '$data->pp_status!=="PO Created"',

                        ),
                    ),

                ),


            ),
        )); ?>
    </div>
</div>

