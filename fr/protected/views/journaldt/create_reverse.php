<?php
/* @var $this JournaldtController */
/* @var $model Voucherdetail */

$this->breadcrumbs=array(
    'General Ledger',
	'Reverse Entry'=>array('journal/adminReverse'),
	'New Reverse Detail',
);

$this->menu=array(
	array('label'=>'<< Go Back to Header', 'url'=>array('journal/createReverse')),
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
    <div id="flag_desc_text">In this screen you need to fill in the fields, before clicking the button <b>“Add New Detail”</b>.  Fields marked with (*) are mandatory. You can go back to Voucher Header to view all Voucher Header information at a glance by clicking the menu tab <b>“<< Go Back to Header”</b>. <b>Action</b> buttons will allow you to update and delete. You can post the voucher to GL by clicking the button <b>"POST To GL"</b> and view reports by clicking <b>"pdf"</b> or <b>"xls"</b> icon button.</div>
</div>



<div style="width: 98%; float: left;">
    <div style="width: 46%; float: left; margin-right: 3%; ">
        <?php $this->renderPartial('_form', array('model'=>$model)); ?>
    </div>
    <div style="width: 51%; float: left; ">

        <h1 style="background: #FFCCFF; padding: 5px; width: 98%; font-weight: bold; text-align: center;">
            Reverse Entry # <span style="color: blue;"> <?php echo $am_vouchernumber; ?></span> with Details
        </h1>

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'voucherdetail-grid',
            'dataProvider'=>$journaldt->searchdt($am_vouchernumber),
            'filter'=>$journaldt,
            'columns'=>array(
                //'id',
                //'am_vouchernumber',
                'am_accountcode',
                array( 'name'=>'account_search', 'value'=>'$data->accountname->am_description' ),
                'am_currency',
                'am_exchagerate',
                'am_primeamt',
                'am_baseamt',
                //'am_branch',
                //'am_note',

                array(
                    'class'=>'CButtonColumn',
                    'header'=>'Action',
                    'template'=>'{update}{delete}',

                    'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',

                    'buttons'=>array
                    (
                        'update' => array
                        (
                            'label'=>'update',
                            'url'=>'Yii::app()->createUrl("journaldt/updateReverse/",
                                    array("id"=>$data->id, "am_vouchernumber"=>$data->am_vouchernumber))',
                        ),

                    ),
                ),
            ),
        )); ?>

        <div>
            <div style="width: 98%; float: left; text-align: right; background: #ccc; font-weight: bold; padding: 5px;">
                    <div style="width: 40%; float: left;">Total </div>
                    <div style="width: 26%; float: left;" id="prime-amt"><?php echo $primeamt; ?></div>
                    <div style="width: 17%; float: left;" id="base-amt"><?php echo $baseamt; ?></div>
            </div>
        </div>

        <div id="notice_amt" style="width: 98%; float: left; padding: 5px; font-size: 16px; font-weight: bold; background: blanchedalmond;">

        </div>

        <div style="width: 99%; float: left; text-align: center;">
            <?php echo CHtml::link('POST to GL', array('PostToGlRv', 'am_vouchernumber'=>$am_vouchernumber), array('class'=>'btn_btn', 'id'=>'togglee', 'style'=>'height: 21px; text-align: center; width: 143px;  box-shadow: 10px 3px 5px #aaa;  ')); ?>

            <div id="report_icon">
                <?php
                echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/images/action_btn_pdf.png'), array('sareport/singleVoucher', 'pVoucherNo'=>$am_vouchernumber), array('target'=>'_blank'));
                ?>
                <?php
                echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/images/action_btn_xls.png'), array('sareport/singleVouchers', 'pVoucherNo'=>$am_vouchernumber), array('target'=>'_blank'));
                ?>
            </div>

        </div>

        <style type="text/css">
            #report_icon img{
                margin-top: 25px;
                margin-left: 25px;
                box-shadow: 1px 1px 1px #aaa;
            }
        </style>

    </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $(function(){
            var prime_amt = document.getElementById("prime-amt").innerHTML;
            var base_amt = document.getElementById("base-amt").innerHTML;
            if(prime_amt > 0 || base_amt>0 || prime_amt < 0 || base_amt < 0 ){
                $("#notice_amt").text("WARNING Report : The journal must balance ie. debits equal to credits before it can be processed").css('color', 'red');
                document.getElementById('togglee').style.visibility = 'hidden';
            }else{
                $("#notice_amt").text("Journal Balanced").css('color', 'green');
                document.getElementById('togglee').style.visibility = 'visible';
            }
        });
    });
</script>