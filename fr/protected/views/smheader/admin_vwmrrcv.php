<?php Yii::app()->clientscript->scriptMap['jquery.js'] = false; ?>
<?php
/* @var $this SmheaderController */
/* @var $model Smheader */

$this->breadcrumbs=array(
    'Sales',
    'Money Receipt'=>array('smheader/adminmoneyreceipt'),
    'View MR Allocation',
);

$this->menu=array(
    array('label'=>'<< Back to Money Receipt', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('smheader/adminmoneyreceipt')),
    /*array('label'=>'Post to GL', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/post_gl_a.png" /></span>{menu}', 'url'=>array('smheader/mrPostToGl')),
    array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
        'items'=>array(
                array('label'=>'Money Receipt No', 'url'=>array('transaction/managemoneyreceiptno')),
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

<!--
<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text"> Allocation Invoice</div>
</div>
-->



<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'sm-header-grid',
    'dataProvider'=>$model->search($sm_number),
    //'filter'=>$model,
    'columns'=>array(
       'sm_number',
        //array('name'=>'customer_search', 'value'=>'$data->customer->cm_name' ),
        'sm_invnumber',
        'sm_amount',
        'sm_balanceamt',

    ),
)); ?>

