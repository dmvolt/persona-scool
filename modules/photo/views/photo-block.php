<?php
use yii\helpers\Html;
use app\components\helpers\Text;
use app\modules\file\components\Img;
?>
<div class="col-md-6 col-sm-12 col-xs-12">
	<?php if($block->files):?>
		<div id="about-us-slider" class="owl-carousel owl-theme slider positionR marB30">
			<?php foreach($block->files as $file):?>
				<div class="item">
					<figure>
						<img src="<?= Img::_('photo', $block->id, 'middle', $file->filename) ?>" alt="">
					</figure>
				</div>
			<?php endforeach;?>
		</div>
	<?php endif;?>
</div>
<div class="col-md-6 col-sm-12 col-xs-12">
	<div class="about-us marB0">
		<h3 class="marB10"><?= $block->title ?></h3>
		<?= $block->teaser ?>
		<a href="/<?= $block->alias ?>" class="itg-button">Подробнее</a>
	</div>
</div>