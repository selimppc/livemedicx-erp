<?php
/* @var $this VouhcerheaderController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
	'Voucher'=>array('admin'),
	'Custom Journal Transaction',
);

$this->menu=array(
	//array('label'=>'List Voucher Header', 'url'=>array('index')),
	array('label'=>'>> Custom Journal Transaction',  'url'=>array('customJournalTransaction')),

); 
?>
<style type="text/css">
	#print_wraper{
		width: 98%;
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
    <div id="flag_desc_text"> Custom Journal Transaction </div>
</div>

<div id="print_wraper">

	<h2>Custom Journal Transaction </h2>
		<h3>From Date: <?php echo $from_date ?> - To Date: <?php echo $to_date ?></h3>

	<?php foreach ($result as $values):?><br>
		<table style="width: 40%;">
			<tr>
				<td> <b>Voucher Number:</b> </td> <td> <?php echo $values['am_vouchernumber']; ?> </td>
				<td> <b>Year:</b> </td> <td><?php echo $values['am_year']; ?> </td>
			</tr>
			<tr>
				<td> <b>Date:</b> </td> <td> <?php echo $values['am_date']; ?> </td>
				<td> <b>Period:</b> </td> <td><?php echo $values['am_period']; ?> </td>
			</tr>
			<tr>
				<td> <b>Branch:</b> </td> <td> <?php echo $values['am_branch']; ?> </td>
				<td> <b>Reference:</b> </td> <td><?php echo $values['am_referance']; ?> </td>
			</tr>
		</table>	
				
			<?php $this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'vouhcerheader-grid',
				'dataProvider'=>$model->customJournalTransaction($values['am_vouchernumber'], $am_branch, $from_date, $to_date),
			
				'columns'=>array(
					'am_accountcode',
					'am_description',
					//'debit',
					array('name'=>'debit','htmlOptions'=>array('style' => 'text-align: right;')),
		
					//'credit',
					array('name'=>'credit','htmlOptions'=>array('style' => 'text-align: right;')),
		
				),
			)); ?>
			
			<table style="float: left; margin-left: 48%; text-align: center; width: 52%; ">
				<tr style="font-weight: bold; text-align: right;"> 
					<td> Total: </td>
					<td> <?php echo $values['debit']; ?> </td> 
					<td> <?php echo $values['credit']; ?> </td> 
				</tr>
			</table>

	<?php endforeach; ?>

</div>	

