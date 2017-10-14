<?php
/* @var $this BranchmasterController */
/* @var $model Branchmaster */

$this->breadcrumbs=array(
	'Branch Masters'=>array('admin'),
	'Manage Branch Master',

);

$this->menu=array(
	//array('label'=>'List Branchmaster', 'url'=>array('index')),
	array('label'=>'New Branch Master', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Currency', 'url'=>array('branchmaster/BranchCurrency')),
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
        <b>Manage Branch Master</b>: This screen will allow you to view the overall branch’s detail; you can search specific data by selecting any title columns. By clicking the icons under <b>“Action”</b> column will allow you to update and delete the specific data. You can also open a data entry screen to input new Information(s) by clicking the Menu tab <b>“New Branch Master”</b>.</div>
</div>




<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'branchmaster-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cm_branch',
		//array(
		//	'class'=>'CLinkColumn',
        //    'header'=>'Branch Name',
        //    'labelExpression'=>'$data->cm_branch',
            //'urlExpression'=>'Yii::app()->createUrl("Purchaseorddt/PurchaseOrderNumberS1", array("pp_purordnum"=>$data->pp_purordnum))',
		//	'urlExpression'=>'array("branchcurrency/admin","cm_branch"=>$data->cm_branch)',
			//'linkHtmlOptions'=>array('target'=>'_blank'),

        //    ),
		'cm_currency',
        'cm_exchrate',
		'cm_description',
		'cm_contacperson',
		'cm_designation',
		'cm_mailingaddress',
		'cm_phone',
        'inserttime',
        'insertuser',
		/*
		'cm_cell',
		'cm_fax',
		'active',
		'inserttime',
		'updatetime',
		'insertuser',
		'updateuser',
		*/
		array(
			'class'=>'CButtonColumn',
			'header' => 'Action',
			'template'=>'{view}{update}{delete}',

            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

            'buttons'=>array
            (
                'view' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("branchmaster/view/", 
                                            array("cm_branch"=>$data->cm_branch, 
											))',
                ),
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("branchmaster/update/", 
                                            array("cm_branch"=>$data->cm_branch,
											))',
                ),
                'delete'=> array
                (
                    'url'=>
                    'Yii::app()->createUrl("branchmaster/delete/", 
                                            array("cm_branch"=>$data->cm_branch,
											))',
                ),
            ),
		),
	),
)); ?>
