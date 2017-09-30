<?php
/* @var $this RequisitionhdController */
/* @var $model Requisitionhd */

$this->breadcrumbs=array(
	'Requisition'=>array('admin'),
	'Manage Requisition Header',
);

$this->menu=array(
	//array('label'=>'List Requisition', 'url'=>array('index')),
	array('label'=>'New Requisition Header', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Requisition Number', 'url'=>array('transaction/ManageRequisitionNum')),
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
    <div id="flag_desc_text">
        <b>Manage Requisition Header </b>: This screen will allow you to view the overall Requisition Header’s detail; you can search specific data by selecting any title columns. By clicking the icons under <b>“Action”</b> column will allow you to update and delete. You can also open a data entry screen to input new Reverse Entry’s Information by clicking the Menu tab <b>“New Requisition Header”</b>.  Also you can create Purchase Order by clicking the icon of <b>“PO create by RE”</b> under the <b>” Create PO”</b> column.


    </div>
</div>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'requisitionhd-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'pp_requisitionno',
			array(
					'class'=>'CLinkColumn',
                    'header'=>'Requisition Number',
                    'labelExpression'=>'$data->pp_requisitionno',
					//'linkHtmlOptions'=>array('target'=>'_blank'),
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
		'pp_note',
		'pp_status',
        'inserttime',
        'insertuser',
        /*
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
		*/
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

		array(
			'class'=>'CButtonColumn',
			'header' => 'Create PO',
			'template' => '{PObyRE}',

			'buttons' => array(
                   'PObyRE' => array(
                    'label'=>'PO Create by RE ',     // text label of the button
                    'url'=>'Yii::app()->createUrl("requisitionhd/PoCreatebyRe/",
                                        array("id"=>$data->id, "pp_requisitionno"=>$data->pp_requisitionno ))',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/create.png',
        			'visible' => '$data->pp_status=="Open"',
					),

        	),
		),
	),
)); ?>
