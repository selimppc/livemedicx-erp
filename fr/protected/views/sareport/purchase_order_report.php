<?php
/* @var $this SareportController */

$this->breadcrumbs=array(
	'Purchase Module'=>array('sareport/purchaseReports'),
	'Purchase Order Reports',
);

$this->menu=array(
	array('label'=>'<< Back to Report Tool', 'url'=>array('sareport/itemLedger'))
);
?>
<style type="text/css">
	.ui-datepicker-trigger{
		border: none;
		background: none;
	}
	.hasDatepicker{
		padding: 3px;
	}
	
	table tr td select, #from_date, #to_date{
		padding: 15px;
		width: 220px;
		font-size: 14px;
	}
	table tr th{
		width: 300px;
	}

</style>


<div id="flag_desc">
    <div id="flag_desc_img"><img src="<?php echo Yii::app()->baseUrl.'/images/why.png'; ?>" /></div>
    <div id="flag_desc_text">
        <b> Commande d'Achat </b>: Sur cet écran, sélectionner le numéro de commande d'Achat dans le menu déroulant. Pour rapporter en pdf ou xls, cliquer sur <b>PDF</b> ou <b>XLS</b> respectivement. ***  L'affichage des données dans le livres comptable est nécessaire pour la consultation et le résultat. Vous pouvez revenir aux Outils de Rapportage  pour afficher tous les outils de rapportage en cliquant sur l'onglet du menu <b>"Retour au rapport»</b>.

	</div>
</div>

<div style="clear: both;"></div>

<?php echo CHtml::beginForm($this->createUrl('/sareport/purchaseOrderReports'), 'POST', array('target'=>'_blank'))?>

<table style="text-align: left; ">
	  <tr>
	    <th> Purchase Order Number List: </th>
	  </tr>
	  <tr>
	  	<td> <?php echo CHtml::activeDropDownList($model, 'pp_purordnum', CHtml::listData(Purchaseordhd::model()->findAll(array('order'=>'pp_purordnum ASC')), 'pp_purordnum', 'pp_purordnum'), array('empty'=>'- Select PO Number -', 'required'=>TRUE)); ?> </td>
	  </tr>
</table>

	<div class="row buttons">
		<div class="row status-container">
          <div class="span4 action-bar">
			<?php echo CHtml::submitButton('To PDF', array('class'=>'action-btn', 'id'=>'action-btn-pdf', 'name' => 'topdf', 'style'=>'margin-right: 10px;')); ?>
			<?php echo CHtml::submitButton('To XLS', array('class'=>'action-btn', 'id'=>'action-btn-xls', 'name' => 'topxls')); ?>
		  </div>
        </div>
	</div>
<?php echo CHtml::endForm(); ?>

