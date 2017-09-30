<?php
/* @var $this ProductmasterController */
/* @var $model Productmaster */

$this->breadcrumbs=array(
	'Purchase'=>array('purchaseordhd/admin'),
	'Purchase Order Number',
);

$this->menu=array(
	// array('label'=>'List Productmaster', 'url'=>array('index')),
	array('label'=>'New Purchase Order Detail',  'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}',
		'url'=>array('create','pp_purordnum'=>$pp_purordnum, 'pp_status'=>$pp_status),
		'visible'=>$pp_status=="Open",
	),
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
    <div id="flag_desc_text">Purchase Order Detail List: View of the detail list according to PO # <?php echo $pp_purordnum; ?>. To add more detail please click on "New Purchase Order Detail". Or You can Manage existing Detail with the action button at last column of the table.</div>
</div>


<?php 
	$viewarray = array
				(
					'label'=>'view',
					//'value'=>'function ($data , $row) use ($pp_status){return ($data["pp_status"]=="GRN Created")?"GRN Created":$status_names[$data["status"]];}',
					'url'=>'Yii::app()->createUrl("purchaseorddt/view/", array(
						"id"=>$data->id, "pp_purordnum"=>$data->pp_purordnum, "pp_status"=>$data->pp_status
						
					))', 
					//'click'=>'function(){alert("Going view!");}',
				);
				
	$updatearray = array
				(
					'label'=>'update',
					'url'=>'Yii::app()->createUrl("purchaseorddt/update/", array(
						"id"=>$data->id, "pp_purordnum"=>$data->pp_purordnum, "pp_status"=>$data->pp_status
						))',
					'visible'=>($pp_status=="Open"?'true':'false'),
				);
	$deletearray = array
				(
					'label'=>'delete',
					'visible'=>($pp_status=="Open"?'true':'false'),
				);
			
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'class-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$result,

	'columns'=>array(
		'id',
		'pp_purordnum',
		'cm_code',
		'pp_quantity',
		//'pp_grnqty',
		'pp_unit',
		'pp_unitqty',
		'pp_purchasrate',
		//array('name'=>"status",'value'=>'$data->pp_status'),
    	
        array(
            'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

            'buttons'=>array
            (
            	'view' => $viewarray,
                'update' => $updatearray,   
				'delete' => $deletearray, 

            
        ),
	),
))); ?>
