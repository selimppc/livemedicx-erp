<?php
/* @var $this AdjustdtController */
/* @var $model Adjustdt */

$this->breadcrumbs=array(
    'Inventory',
    'Stock Adjustment'=>array('adjusthd/admin'),
    'New Stock Adjustment',
    'Detail',
);

$this->menu=array(
    array('label'=>'<< Back to Adjustment Header', 'url'=>array('adjusthd/admin')),
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
        <b>Stock Adjustment Detail</b>: In this screen, all of the required fields need to be filled before clicking the button <b>“Add Adjustment Detail”</b>. Fields marked with (*) are mandatory. You can go back to your homescreen to view Adjustment Header’s information by clicking the menu tab <b>“Manage Adjustment Header”</b>. <b>Action</b> buttons will allow you to update and delete.
    </div>
</div>


<div style="width: 99%; float: left;">
    <div style="width: 47%; float: left; margin-right: 3%;">
        <div style="background-color: #FFCCFF; width: 87%; text-align: center; color: #808080;">
            Enter your product data for
              <span style="color: orangered; font-weight: bold;" >
                  <?php
                  if($adjStatus =='1'){
                      echo "Postive Adjustment";
                  }else if($adjStatus =='-1'){
                      echo "Negative Adjustment";
                  }
                  ?>
              </span>
        </div>
        <?php $this->renderPartial('_form', array('model'=>$model, 'branch'=>$branch, 'adjStatus'=>$adjStatus)); ?>
    </div>

    <div style="width: 50%; float: left;">

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'adjustdt-grid',
            'dataProvider'=>$adjustDt->search($transaction_number),
            'filter'=>$adjustDt,
            'columns'=>array(
                //'id',
                //'transaction_number',
                'product_code',
                array( 'name'=>'product_search', 'value'=>'$data->product->cm_name' ),
                'batch_number',
                'expirry_date',
                'unit',
                'quantity',
                'stock_rate',

                array(
                    'class'=>'CButtonColumn',
                    'header'=>'Action',
                    'template'=>'{update}{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',


                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'url'=>
                            'Yii::app()->createUrl("adjustdt/update/",
                                                    array("id"=>$data->id, "transaction_number"=>$data->transaction_number,
                                                    ))',
                        ),

                    ),
                ),
            ),
        )); ?>

    </div>
</div>

