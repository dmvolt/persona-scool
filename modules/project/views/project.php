<?php

use yii\helpers\Html;
use app\modules\project\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;

use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = ['label' => $this->params['title_module'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $project->title;
$this->params['page_class'] = 'page--obj';
?>
<section class="page__section page__section--dark page__section--obj">
	<div class="page__background js-rellax" data-rellax-speed="-5"<?php if($project->bg):?> style="background-image: url(/files/project/<?= $project->id ?>/<?= $project->bg->filename ?>);"<?php endif;?>>
		<video autoplay="" class="video display--md-n" loop="" muted="">
			<?php if($project->videoMp4):?>
				<source src="/video/project/<?= $project->id ?>/<?= $project->videoMp4->filename ?>" type="video/mp4">
			<?php endif;?>
			<?php if($project->videoWebm):?>
				<source src="/video/project/<?= $project->id ?>/<?= $project->videoWebm->filename ?>" type="video/webm">
			<?php endif;?>
			<?php if($project->videoOgv):?>
				<source src="/video/project/<?= $project->id ?>/<?= $project->videoOgv->filename ?>" type="video/ogg">
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
							<?= $project->text1 ?>
						</article>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="page__section">
	<div class="page__cont page__cont--fluid padding-t2">

		<?php if($project->files):?>
			<!-- block swiper-slider start -->
			<div class="swiper swiper--gal">
				<div class="swiper-container js-carousel">
					<div class="swiper-wrapper">
					
						<?php foreach($project->files as $file):?>
							<div class="swiper-slide">
								<img src="<?= Img::_(Module::getInstance()->imagesDirectory, $project->id, '1200x700', $file->filename) ?>">
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
					<?= $project->text2 ?>
				</article>
			</div>
			<div class="flex__item flex__item--6 flex__item--lg--12">
				<article class="article">
					<?= Text::_edit($project->id, 'project') ?> <!-- Ссылка на редактирование материала -->
					<?= $project->body ?>
				</article>
			</div>
		</div>
	</div>
</section>