<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\file\components\Img;
?>
<?php if ($content): ?>
	<div class="swiper">
		<div class="swiper-container js-swiper">
			<div class="swiper-wrapper">
				<?php foreach($content as $item): ?>
					<div class="swiper-slide">
						<!-- block pic start -->
						<div class="pic">
							<?php if($item->thumb): ?>
								<?php if(!empty($item->text_block2)): ?>
									<a href="<?= $item->text_block2 ?>"><img src="<?= Img::_('slider', $item->id, 'full-width', $item->thumb->filename) ?>" class="pic__img"></a>
								<?php else: ?>
									<img src="<?= Img::_('slider', $item->id, 'full-width', $item->thumb->filename) ?>" class="pic__img">
								<?php endif; ?>
							<?php endif; ?>
						</div>
						<!-- block pic end -->
						<div class="swiper__caption">
							<div class="container">
								<?php if(!empty($item->text_block1)):?>
									<h2 class="text-center text-huge text-up"><?= $item->text_block1 ?></h2>
								<?php endif;?>
								<?php if(!empty($item->text_block3)):?>
									<?= $item->text_block3 ?>
								<?php endif;?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="swiper-button-prev js-slider-prev"><img src="/img/arrow.svg" class="icon icon--big js-svg"></div>
			<div class="swiper-button-next js-slider-next"><img src="/img/arrow.svg" class="icon icon--big js-svg"></div>
		</div>
	</div>
<?php endif; ?>