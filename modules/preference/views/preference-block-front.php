<?php
use yii\helpers\Html;
use app\modules\file\components\Img;
?>
<?php if ($preferences): ?>
	<div class="swiper-container js-slider-carousel">
		<div class="swiper-wrapper">
			<?php foreach($preferences as $item): ?>
			
				<div class="swiper-slide">
					<div class="advantage">
					
						<?php if($item->thumb):?>
							<img src="<?= Img::_('preference', $item->id, 'mini', $item->thumb->filename) ?>" alt="" class="advantage__picture"> <!-- 160X100 -->
						<?php endif; ?>
						
						<div class="advantage__header"><?= $item->title ?></div>
						<div class="advantage__text"><?= $item->teaser ?></div>
					</div>
				</div>
			
			<?php endforeach; ?>
		</div>
		<div class="swiper-slider__pagination"></div>
	</div>
<?php endif; ?>