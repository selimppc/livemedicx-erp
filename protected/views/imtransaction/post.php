<?php
/* @var $this ImtransactionController */
/* @var $model Imtransaction */

$this->breadcrumbs=array(
    'Inventory',
    'POST to GL (COGS)'=>array('imtransaction/PostToGl'),
    'Postings To GL',
);

$this->menu=array(
    array('label'=>'<< Back to POST to GL (COGS)', 'url'=>array('imtransaction/PostToGl')),
    /*array('label'=>'Settings', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/settings_a.png" /></span>{menu}', 'url'=>array(''), 'itemOptions'=>array('class'=>'productsubmenu'),
        'items'=>array(
                array('label'=>'IM Transaction', 'url'=>array('transaction/ManageImTrn')),
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
    <div id="flag_desc_text"><b>What I am posting:</b> In this screen you will be able to View all data which will be posted. For posting go back to <b> "POST to GL (COGS)" </b></div>
</div>


<?php echo CHtml::link('POST to GL (COGS)',array('postToGlPro', 'pBranch'=>$pBranch, 'pFromDate'=>$pFromDate, 'pToDate'=>$pToDate),
    array('class'=>'btn_btn', 'name' => 'proceed',
        'style'=>'width: 200px; margin-left: 1px; margin-bottom: 20px; text-align: center; height: 20px;  margin-top: 0;')
); ?>
        <span style="color: coral; float: left; font-size: 16px; margin-left: 1%; font-weight: bold; margin-top: 8px;">
                << Click the Button for Posting.
         </span>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'imtransaction-grid',
    'dataProvider'=>$post->searchPostings($pBranch, $pFromDate, $pToDate),
    //'filter'=>$post,
    'columns'=>array(
        'im_number',
        //'im_storeid',
        //'im_date',
        'cm_code',
        'cm_name',
        //'im_currency',
        //'im_ExchangeRate',
        //'im_quantity',
        //'im_totalprice',
        'im_basevalue',
        //'im_status',
    ),
)); ?>
