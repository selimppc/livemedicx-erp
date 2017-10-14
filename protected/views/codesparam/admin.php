<?php
$this->breadcrumbs=array(
	'Codes Param'=>array('admin'),
	'Manage',
);

$this->menu=array(
	//array('label'=>'List Codesparams', 'url'=>array('index')),
	array('label'=>'New Codes Param', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('create')),

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
    <div id="flag_desc_text">Manage Codes Params</div>
</div>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'codesparamgrid',
    'dataProvider'=>$model->search(),
    //'filter'=>$model,
    'columns'=>array(
        'cm_type',
        'cm_code',
        'cm_desc',
        'cm_active',
        'inserttime',
        'updatetime',
        'insertuser',
        'updateuser',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{view}{update}{delete}',

            'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',


            'buttons'=>array
            (
                'view' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("codesparam/view/", 
                                            array("cm_type"=>$data->cm_type, "cm_code"=>$data->cm_code
											))',
                ),
                'update' => array
                (
                    'url'=>
                    'Yii::app()->createUrl("codesparam/update/", 
                                            array("cm_type"=>$data->cm_type, "cm_code"=>$data->cm_code
											))',
                ),
                'delete'=> array
                (	
                    'url'=>
                    'Yii::app()->createUrl("codesparam/delete/", 
                                            array("cm_type"=>$data->cm_type, "cm_code"=>$data->cm_code
											))',
                'visible'=> '$data->cm_active=="0"',
                ),
            ),
        ),
    ),
)); ?>
