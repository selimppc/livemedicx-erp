<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>

<nav class="secondary-navigation-holder">
    
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				//'title'=>'Operations',
			));
			$this->widget('zii.widgets.CMenu', array(
			
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'secondary-nav-items'),
			));
			$this->endWidget();
		?>
		<!-- sidebar -->
	
</nav>

<div class="span-19" style="min-height:250px; width: 98.3%; padding: 10px;">
	<div id="content" class="content-grid has-scroll-bar">
		<div class="viewport">
			<?php echo $content; ?>
		</div>	
	</div><!-- content -->
</div>

<?php $this->endContent(); ?>