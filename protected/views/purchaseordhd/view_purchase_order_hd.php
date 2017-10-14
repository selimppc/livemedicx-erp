<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(
	'GRN'=>array('purchaseordhd/ViewPurchaseOrderHd'),
	'Create GRN from Purchase Order',
);

$this->menu=array(
	//array('label'=>'List Productmaster', 'url'=>array('index')),
	array('label'=>'GRN History', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/grn_a.png" /></span>{menu}', 'url'=>array('purchaseordhd/ViewPurchaseOrderHd')),
	array('label'=>'Manage GRN', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('purchaseordhd/ViewGrn')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'GRN Number', 'url'=>array('transaction/ManageGRNnumnber')),

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
    <div id="flag_desc_text"><b>Create GRN from Purchase Order: </b> In this screen you will be able to view all purchase order history for creating <b>GRN</b>. To create new GRN, click on the button<b>"Create GRN"</b> under <b>"Action"</b> column. You can also view the reports by clicking the link under <b>PO Number</b> column. To view <b>GRN</b> history with details click on the menu tab <b>"Manage GRN"</b> </div>
</div>


<br>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	
	'columns'=>array(
		//'id',
		//'pp_purordnum',
        array(
            'class'=>'CLinkColumn',
            'header'=>'PO Number',
            'labelExpression'=>'$data->pp_purordnum',
            'urlExpression'=>'array("sareport/singlePoGrn","pPoNumber"=>$data->pp_purordnum)',
            'linkHtmlOptions'=>array('target'=>'_BLANK'),
        ),
		'cm_supplierid',
		'cm_orgname',
		'Order_Date',
		'Delivery_Date',
		'pp_status',

    	
        array(
            'class'=>'CButtonColumn',
        	'header' => 'Action',
			'template' => '{GRN}',
			
			'buttons' => array(
                   'GRN' => array(
                    'label'=>'Create GRN',     // text label of the button
                    'url'=>'Yii::app()->createUrl("purchaseordhd/CreateGRN/", array("id"=>$data->id))', 
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/create.png', 
        			'visible' => '$data->pp_status=="Approved" OR $data->pp_status=="Part Received"',
					),
             
        	),
	),
))); ?>
