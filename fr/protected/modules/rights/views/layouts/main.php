<?php $this->beginContent(Rights::module()->appLayout); ?>

<div id="rights" class="container">

	<div id="content">

		<?php if( $this->id!=='install' ): ?>

			<div id="menu" class="secondary-navigation-holder">

				<?php $this->renderPartial('/_menu'); ?>

			</div>

		<?php endif; ?>

		<?php $this->renderPartial('/_flash'); ?>

		<?php echo $content; ?>

	</div><!-- content -->

</div>

<?php $this->endContent(); ?>