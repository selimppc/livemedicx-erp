<?php
$this->breadcrumbs=array(
    'Sales',
    'Settings'=>array('transaction/salesSettings'),
);

?>

<style type="text/css">
    #report_main_div{
        width: 96%;
        float: left;
        color: orange;
        margin-left: 20px;

    }
    #report_button{
        width: 33%;
        float: left;
        border-radius: 10px;

    }

    #report_button a {
        text-decoration: none;
        color: white;
        width: 60%;
        float: left;
        text-align: center;
        margin-bottom: 20px;
        padding: 13px 35px;
        background: #4085BB;
        border-radius: 10px;
        font-size: 16px;
        box-shadow: 10px 3px 5px #aaa;
    }
    #report_button a:hover {
        background: #2F6088;
    }

</style>


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
    <div id="flag_desc_text"><b>Sales Settings Tool:</b> This screen facilities information flow between all Sales functions. By clicking the tab options will navigate to desired screen.  </div>
</div>


<div id="notice_amt" style="width: 98%; float: left; padding: 10px; font-size: 16px; font-weight: bold; background: blanchedalmond; color: red; margin-bottom: 20px;  box-shadow: 10px 3px 5px #aaa;">
    <b>Warning Message: This settings option is only for the System Administrator. </b>

</div>


<div style="width: 98%; margin: 0 auto;">

    <div id="report_main_div">
        <div id="report_button">
            <?php echo CHtml::link('Invoice Number',array('transaction/createinvoiceno')); ?>
        </div>
    </div>
	

    <div id="report_main_div">
        <div id="report_button">
            <?php echo CHtml::link('Sales Return Number',array('transaction/createSalesReturnNo')); ?>
        </div>
    </div>
    
	<div id="report_main_div">
		<div id="report_button">
			<?php echo CHtml::link('Money Receipt Number',array('transaction/createMoneyReceiptNo')); ?>
		</div>
	</div>

    <div id="report_main_div">
        <div id="report_button">
            <?php echo CHtml::link('Sync Sales/Gerant Order', array('CloudApi/FetchJsonData'), array('onclick'=>'$("#onload-view").dialog("open"); return false;', 'style'=>'color: yellow')); ?>
        </div>
    </div>


   <!--  <div id="report_main_div">
        <div id="report_button">
            <?php //echo CHtml::link('Upload to Gerant Status', array('CloudApi/PostToCloud'), array('onclick'=>'$("#upload-gerant").dialog("open"); return false;', 'style'=>'color: yellow' )); ?>
        </div>
    </div>
 -->


<!--
	<div id="report_main_div">
		<div id="report_button">
			<?php echo CHtml::link('User Report',array('default/billadmin')); ?>
		</div>
	</div>
	 -->
</div>




<script>
    $(document).ready(function(){
        $('#test-sync').click(function(){
            $('#loader').show();
            $('#action-infor').hide();
            $.ajax({
                url: '<?php echo Yii::app()->baseUrl . '/index.php/cloudApi/FetchJsonData' ?>',
                type: 'post',
                //data: {data:},
                success: function (data) {
                    $('#loader').hide();
                    $('#action-infor').show();
                    //$('#test-sync').text(data);
                    alert(data);
                }
            });
        });

        $('#up-test-sync').click(function(){
            $('#up-loader').show();
            $('#up-action-infor').hide();
            $.ajax({
                url: '<?php echo Yii::app()->baseUrl . '/index.php/cloudApi/PostToCloud' ?>',
                type: 'post',
                //data: {data:},
                success: function (data) {
                    $('#up-loader').hide();
                    $('#up-action-infor').show();
                    //$('#test-sync').text(data);
                    alert(data);
                }
            });
        });
    });
</script>


<?php
//------------ add the CJuiDialog widget -----------------
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'onload-view',
    'options'=>array(
        'title'=>'Sync Data from Cloud ...',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>550,
        'height'=>470,
        ),
    ));
//-------- default code starts here ------------------
?>



<div id="loader" style="display: none; text-align: center; padding-top: 20%">
    <h2> Loading data .... </h2>
    <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/preloader.gif',"Loading..",array());?>
</div>

<div id="action-infor" style="text-align: center; padding-top: 20%">
    <h2> To sync cloud order data please click the button "Confirm Sync" </h2><br>
    <button id="test-sync" style="background-color: seagreen; border: 1px solid #1a1a1a; padding: 2%; color: white; font-weight: normal; cursor: pointer;"> Confirm to Sync </button>
</div>


<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>


<!--    window.parent.$("#Document-Edit").dialog("close");-->


<!-- Upload Gerant Status from the ERP System -->
<?php
//------------ add the CJuiDialog widget -----------------
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'upload-gerant',
    'options'=>array(
        'title'=>'Upload Status to Cloud ...',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>550,
        'height'=>470,
    ),
));
//-------- default code starts here ------------------
?>



<div id="up-loader" style="display: none; text-align: center; padding-top: 20%">
    <h2> Loading data .... </h2>
    <?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/preloader.gif',"Loading..",array());?>
</div>

<div id="up-action-infor" style="text-align: center; padding-top: 20%">
    <h2> To upload sales status to live please click the button "Upload Sync" </h2><br>
    <button id="up-test-sync" style="background-color: orangered; border: 1px solid #1a1a1a; padding: 2%; color: white; font-weight: normal; cursor: pointer;"> Confirm to Upload </button>
</div>


<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>
