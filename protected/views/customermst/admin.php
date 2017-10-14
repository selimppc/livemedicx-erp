<?php
/* @var $this CustomermstController */
/* @var $model Customermst */

$this->breadcrumbs=array(
	'Customer Master'=>array('admin'),
	'Manage',
);

$this->menu=array(
	array('label'=>'New Customer', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}',  'url'=>array('create')),
	/*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
		'items'=>array(
				array('label'=>'Customer Group', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('codesparam/ManageCustomerGroup')),
				array('label'=>'Market', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('codesparam/ManageMarket')),
				array('label'=>'Customer TRN No', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('transaction/manageCustmerTrnNo')),
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
        <b>Manage Customer Master</b>: This screen will allow you to view the overall customer’s detail; you can search specific data by selecting any title columns. By clicking the icons under <b>“Action”</b> column will allow you to update and delete the specific data. You can also open a data entry screen to input new customer Information(s) by clicking the Menu tab <b>“New Customer” </b>
    </div>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'customermst-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cm_group',
		'cm_cuscode',
		'cm_name',
		'gerant_id',
		'cm_address',
		//'cm_territory',
		'cm_cellnumber',
		'cm_phone',
		'c_type',
		'cm_fax',
		'cm_email',
		'cm_branch',
		'cm_market',
		'cm_sp',

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
                    'Yii::app()->createUrl("customermst/view/", 
                                            array("cm_cuscode"=>$data->cm_cuscode, 
											))',
                ),
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("customermst/update/", 
                                            array("cm_cuscode"=>$data->cm_cuscode,
											))',
                ),
                'delete'=> array
                (
                    'url'=>
                    'Yii::app()->createUrl("customermst/delete/", 
                                            array("cm_cuscode"=>$data->cm_cuscode,
											))',
                ),
            ),
		),
	),
)); ?>
