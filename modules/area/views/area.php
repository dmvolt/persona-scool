<?php

use yii\helpers\Html;
use app\modules\area\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;

use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = ['label' => $this->params['title_module'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $area->title;
$this->params['page_class'] = 'page--obj';
?>
<section class="page__section page__section--dark page__section--obj">
	<div class="page__background js-rellax" data-rellax-speed="-5"<?php if($area->bg):?> style="background-image: url(/files/project/<?= $area->id ?>/<?= $area->bg->filename ?>);"<?php endif;?>>
		<video autoplay="" class="video display--md-n" loop="" muted="">
			<?php if($area->videoMp4):?>
				<source src="/video/area/<?= $area->id ?>/<?= $area->videoMp4->filename ?>" type="video/mp4">
			<?php endif;?>
			<?php if($area->videoWebm):?>
				<source src="/video/area/<?= $area->id ?>/<?= $area->videoWebm->filename ?>" type="video/webm">
			<?php endif;?>
			<?php if($area->videoOgv):?>
				<source src="/video/area/<?= $area->id ?>/<?= $area->videoOgv->filename ?>" type="video/ogg">
			<?php endif;?>
		</video>
	</div>
	<div class="page__cont">
		<div class="flex flex--center flex--gap-1 flex--vgap-1">
			<div class="flex__item flex__item--8 flex__item--md--12">
				<div class="box">
					<div class="box__bg"></div>
					<div class="box__content">
						<article class="article">
							<?= $area->text1 ?>
						</article>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="page__section">
	<div class="page__cont page__cont--fluid padding-t2">

		<?php if($area->files):?>
			<!-- block swiper-slider start -->
			<div class="swiper swiper--gal">
				<div class="swiper-container js-carousel">
					<div class="swiper-wrapper">
					
						<?php foreach($area->files as $file):?>
							<div class="swiper-slide">
								<img src="<?= Img::_(Module::getInstance()->imagesDirectory, $area->id, '1200x700', $file->filename) ?>">
							</div>
						<?php endforeach;?>
					</div>

					<div class="swiper-button-prev"><svg class="icon icon--huge icon--flip"><use xlink:href="/img/sprite.svg#arrow"></svg></div>
					<div class="swiper-button-next"><svg class="icon icon--huge"><use xlink:href="/img/sprite.svg#arrow"></svg></div>
				</div>
			</div>
			<!-- block swiper-slider end -->
		<?php endif;?>
	</div>
	<div class="page__cont padding-b2">
		<div class="flex flex--gap-1">
			<div class="flex__item flex__item--6 flex__item--lg--12">
				<article class="article">
					<?= $area->text2 ?>
				</article>
			</div>
			<div class="flex__item flex__item--6 flex__item--lg--12">
				<article class="article">
					<?= Text::_edit($area->id, 'area') ?> <!-- Ссылка на редактирование материала -->
					<?= $area->body ?>
				</article>
			</div>
		</div>
	</div>
</section>