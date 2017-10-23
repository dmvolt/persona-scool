<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\file\components\Img;
?>
<?php if ($content): ?>
	<div class="page__mobile swiper--header">
		<?php foreach($content as $item): ?>
			<div class="swiper-slide">
				<div class="swiper__container">
					<div class="flex">
						<div class="flex__item flex__item--50 swiper__left">
							<?php if($item->thumb): ?>
								<img src="<?= Img::_('slider', $item->id, '1600x400', $item->thumb->filename) ?>" class="swiper__caption">
							<?php endif; ?>
						</div>
						<div class="flex__item flex__item--50 swiper__right">
							<div class="swiper__text">
								<?php if(!empty($item->text_block1)):?>
									<div class="swiper__header"><?= $item->text_block1 ?></div>
								<?php endif;?>
								<?php if(!empty($item->text_block3)):?>
									<div class="swiper__mobile-hide">
										<?= $item->text_block3 ?>
									</div>
								<?php endif;?>
							</div>
						</div>
					</div>

					<?php if(!empty($item->text_block2)): ?>
						<a href="<?= $item->text_block2 ?>" class="button page__mobile-button js-ripple"><img src="/img/1_menu_news-01.svg" class="icon icon--big js-svg"> перейти</a>			
					<?php endif; ?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>