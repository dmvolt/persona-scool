<?php
use app\modules\file\components\Img;
?>
<?php if ($content): ?>
	<?php foreach ($content as $item): ?>

		<div class="item positionR">
			<figure class="slider-image positionR">
				<img src="<?= Img::_('slider', $item->id, '1920x846', $item->thumb->filename) ?>" alt="" class="hidden-xs">
				<?php if ($item->thumb2): ?>
					<img src="<?= Img::_('slider', $item->id, '1920x1080', $item->thumb2->filename) ?>" class="hidden-sm hidden-lg hidden-md">
				<?php endif; ?>
			</figure>
			<div class="slider-text positionA text-center">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-10 col-md-offset-2 col-sm-offset-2 col-xs-offset-1 text-center">
							<?php if (!empty($item->text_block1)): ?>
								<h1><?= $item->text_block1 ?></h1>
							<?php endif; ?>
							
							<?php if (!empty($item->text_block3)): ?>
								<?= $item->text_block3 ?>
							<?php endif; ?>
							
							<?php if (!empty($item->text_block2)): ?>
								<a href="<?= $item->text_block2 ?>" class="itg-button"><?= $item->button_text ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php endforeach; ?>
<?php endif; ?>