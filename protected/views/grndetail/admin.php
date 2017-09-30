<?php
/* @var $this GrndetailController */
/* @var $model Grndetail */

$this->breadcrumbs=array(
	'Manage GRN'=>array('purchaseordhd/ViewGrn'),
	'Manage GRN Detail',
);

$this->menu=array(
	//array('label'=>'List Grndetail', 'url'=>array('index')),
	//array('label'=>'Create Grndetail', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create', 'vGrnNumber'=>$im_grnnumber, 'pp_purordnum'=>$im_purordnum,)),
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
    <div id="flag_desc_text">Manage Grn Details</div>
</div>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'grndetail-grid',
	'dataProvider'=>VwGrndetail::model()->search($im_grnnumber),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		'im_grnnumber',
		'cm_code',
		'cm_name',
		'im_BatchNumber',
		'im_ExpireDate',
		'im_RcvQuantity',
		'im_costprice',
		'im_unit',
		'im_unitqty',
		'im_rowamount',
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

        'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

		'header'=>'Action',
		'buttons'=>array
            (
				'update' => array
				(
					'url'=>
                    'Yii::app()->createUrl("grndetail/UpdateGrndt/", 
                         array("id"=>$data->id, "im_grnnumber"=>$data->im_grnnumber, "cm_code"=>$data->cm_code,
					))',
				),   
				
				'delete' => array
				(
					'url'=>
                    'Yii::app()->createUrl("grndetail/delete/", 
                         array("id"=>$data->id
					))',
				), 
			)
		)
	),
)); ?>
