<?php
use yii\helpers\Html;
use app\modules\sert\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;

use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = $this->params['title_h1'];
$this->params['page_class'] = 'page--obj';
?>
<section class="page__section page__section--dark">
	<div class="page__background js-rellax" data-rellax-speed="-5"></div>
	<div class="page__cont padding-b2">
		<div class="h1"><?= $this->params['siteinfo']->title ?></div>
		<h2><?= $this->params['siteinfo']->slogan ?></h2>
	</div>
</section>

<section class="page__section">
	<div class="page__cont">
		<!-- block breadcrumbs start -->
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<!-- block breadcrumbs end -->
		<h1><?= Html::encode($this->params['title_h1']) ?></h1>
		<hr>
	</div>
</section>

<section class="page__section">
	<div class="page__cont padding-b2">
		<div class="flex flex--gap-1">
		
			<?php if ($serts): ?>
				<?php foreach($serts as $sert): ?>
					<div class="flex__item flex__item--6 flex__item--lg--12">
						<?php if ($sert->files): ?>
							<!-- block swiper-slider start -->
							<div class="swiper swiper--full">
								<div class="swiper-container js-swiper-1">
									<div class="swiper-wrapper">
										<?php foreach($sert->files as $item): ?>
										
											<div class="swiper-slide">
												<img class="js-zoom" src="<?= Img::_(Module::getInstance()->imagesDirectory, $sert->id, '500x700', $item->filename) ?>" data-zoom-image="<?= Img::_(Module::getInstance()->imagesDirectory, $sert->id, '1000x1400', $item->filename) ?>">
											</div>

										<?php endforeach; ?>
									</div>
								</div>
							</div>
							<!-- block swiper-slider end -->
						<?php endif; ?>
						
						<?php if ($sert->files): ?>
							<!-- block swiper-slider start -->
							<div class="swiper swiper--carousel">
								<div class="swiper-container js-carousel-1">
									<div class="swiper-wrapper">
										<?php foreach($sert->files as $item): ?>
										
											<div class="swiper-slide">
												<img src="<?= Img::_(Module::getInstance()->imagesDirectory, $sert->id, '500x700', $item->filename) ?>">
											</div>

										<?php endforeach; ?>
									</div>
									<div class="swiper-button-prev"><svg class="icon icon--big icon--flip"><use xlink:href="/img/sprite.svg#arrow"></svg></div>
									<div class="swiper-button-next"><svg class="icon icon--big"><use xlink:href="/img/sprite.svg#arrow"></svg></div>
								</div>
							</div>
							<!-- block swiper-slider end -->
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>