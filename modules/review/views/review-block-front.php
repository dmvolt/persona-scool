<?php
use yii\helpers\Html;
?>
<?php if ($reviews): ?>
	<div class="flex__item flex__item--40">
		<h2 class="text-up header-link"><a href="/reviews"><img src="/img/feedback.svg" class="icon icon--big js-svg"> <?= Html::encode($titleBlock) ?></a></h2>

		<div class="swiper swiper--feedback">
			<div class="swiper-container js-swiper-feedback">
				<div class="swiper-wrapper">
					<?php foreach($reviews as $item): ?>
						<div class="swiper-slide">
							<div class="mt-2e mb-2e text-small">
								<?= $item->teaser ?>
								<p class="text-right"><em><?= $item->title ?>,<br> <?= $item->position ?></em></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="swiper-slider__pagination"></div>
			</div>
		</div>
	</div>
<?php endif; ?>
