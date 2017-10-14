<?php
/* @var $this VouhcerheaderController */
/* @var $model Vouhcerheader */

$this->breadcrumbs=array(
	'Year End Process'=>array('admin'),
	'New  Year End Process',
);

$this->menu=array(
	array('label'=>'Manage Year End Process', 'template'=>'<span><img src="'.Yii::app()->baseUrl.'/images/manage_a.png" /></span>{menu}', 'url'=>array('admin')),
);
?>

<style type="text/css">
	table .money-receipt-sales, td, th
	{
		border: 1px solid #4E8EC2;
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
        <div id="flag_desc_text"> Year End Process </div>
    </div>



<?php echo CHtml::beginForm($this->createUrl('/billing/default/create'), 'POST')?>

<table>
	<tr> 
		<td colspan="2" style="text-align: center; background: #4085BB; color: white;"> 
			Year End Process
		</td>
	</tr>
	
	<tr>
		<td> Year :  </td>
		<td> <input name="" value=""> </td>
	</tr>
	
	<tr>
		
		<td colspan="2"> 
			
			<?php echo CHtml::submitButton('Proceed to Year', array('style'=>'height: 30px;  border-radius: 5px; cursor: pointer;')); ?>
		</td>
	</tr>

</table>

	
<?php echo CHtml::endForm(); ?>