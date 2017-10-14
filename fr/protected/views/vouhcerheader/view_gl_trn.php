<?php
/* @var $this VouhcerheaderController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
	'Voucher Header'=>array('admin'),
	'GL Transaction',
);

$this->menu=array(
	//array('label'=>'List Voucher Header', 'url'=>array('index')),
	array('label'=>'Voucher Entry', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/create_a.png" /></span>{menu}', 'url'=>array('admin')),

);


?>

<style type="text/css">
	@media print {
		#buttons { display: none; }
		#top-header{ display: none; }
		#sub-header{ display: none; }
		.primary-nav-scroller ps-container{ display: none; }
		#mainmenu{ display: none; }
		.footer{ display: none; }
		.primary-nav-scroller ps-container{display: none;}
		.secondary-navigation-holder{display: none;}
		.primary-navigation-item-list{display: none;}
		#yw3{display: none;}
		#yw4{display: none;}
		aside{display: none;}
		.main-content-holder {margin-left: 0px;}
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
    <div id="flag_desc_text"> Voucher No: <?php echo $am_vouchernumber; ?> </div>
</div>


<div id="print_wraper">

	<h2> Voucher No: <?php echo $am_vouchernumber; ?> </h2>

	<div>
		Date: <?php echo $am_date; ?>&nbsp;&nbsp;&nbsp;&nbsp;  Year: <?php echo $am_year; ?>&nbsp;&nbsp;&nbsp;&nbsp;  Period: <?php echo $am_period; ?>
	</div>

	<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'vouhcerheader-grid',
		'dataProvider'=>$model->search($am_vouchernumber),
		//'filter'=>$model,
		
		'columns'=>array(
			'am_accountcode',
			'am_description',
			//'debit',
			array('name'=>'debit','htmlOptions'=>array('style' => 'text-align: right;')),

			//'credit',
			array('name'=>'credit','htmlOptions'=>array('style' => 'text-align: right;')),

		),
	)); ?>

	<table style="float: left; margin-left: 48%; text-align: center; width: 52%;">

		<tr style="font-weight: bold; text-align: right;"> 
			<td> Total: </td>
			<td> <?php echo $debit; ?> </td> 
			<td> <?php echo $credit; ?> </td> 
		</tr>
	</table>
</div>	

<div id="buttons" style="width: 84%; float: left; text-align: left;">
		<button type="button" onclick="window.print();return false;"  style="background: yellow; border: 1px solid red; padding: 10px;  font-weight: bold; cursor: pointer;">Print</button>
	<div style="clear:both;"></div>
</div>