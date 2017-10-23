<?php
use app\modules\infoblock\components\BlockText;
use app\modules\main\components\BlockForm;
use app\modules\page\components\BlockPage;
use app\modules\news\components\BlockNews;
use app\modules\project\components\BlockProject;
use app\modules\client\components\BlockClient;
use app\modules\partner\components\BlockPartner;

use app\components\helpers\Text;
$this->params['page_class'] = 'page--index';
?>
<section class="page__section page__section--dark">
	<div class="page__background js-rellax" data-rellax-speed="-5"<?php if($this->params['siteinfo']->bg):?> style="background-image: url(/files/main/<?= $this->params['siteinfo']->id ?>/<?= $this->params['siteinfo']->bg->filename ?>);"<?php endif;?>>
		<video autoplay="" class="video display--md-n" loop="" muted="">
			<?php if($this->params['siteinfo']->videoMp4):?>
				<source src="/video/main/<?= $this->params['siteinfo']->id ?>/<?= $this->params['siteinfo']->videoMp4->filename ?>" type="video/mp4">
			<?php endif;?>
			<?php if($this->params['siteinfo']->videoWebm):?>
				<source src="/video/main/<?= $this->params['siteinfo']->id ?>/<?= $this->params['siteinfo']->videoWebm->filename ?>" type="video/webm">
			<?php endif;?>
			<?php if($this->params['siteinfo']->videoOgv):?>
				<source src="/video/main/<?= $this->params['siteinfo']->id ?>/<?= $this->params['siteinfo']->videoOgv->filename ?>" type="video/ogg">
			<?php endif;?>
		</video>
	</div>
	<div class="page__cont padding-b2">
		<h1><?= $this->params['siteinfo']->title ?></h1>
		<h2><?= $this->params['siteinfo']->slogan ?></h2>
		<h3>Предлагаем полный комплекс услуг</h3>
		<div class="flex flex--center flex--gap-1 flex--vgap-1 padding-b4">
			<div class="flex__item flex__item--4 flex__item--md--6 flex__item--xs--12">
				<div class="box">
					<div class="box__bg" style="background-image: url(/img/hbg1.jpg);"></div>
					<div class="box__content">
						<article class="article">
							<?= BlockText::_('service_text_1') ?>
						</article>
					</div>
				</div>
			</div>
			<div class="flex__item flex__item--4 flex__item--md--6 flex__item--xs--12">
				<div class="box">
					<div class="box__bg" style="background-image: url(/img/hbg2.jpg);"></div>
					<div class="box__content">
						<article class="article">
							<?= BlockText::_('service_text_2') ?>
						</article>
					</div>
				</div>
			</div>
			<div class="flex__item flex__item--4 flex__item--md--6 flex__item--xs--12">
				<div class="box">
					<div class="box__bg" style="background-image: url(/img/hbg3.jpg);"></div>
					<div class="box__content">
						<article class="article">
							<?= BlockText::_('service_text_3') ?>
						</article>
					</div>
				</div>
			</div>
		</div>
		<?= BlockProject::front() ?>
	</div>
</section>

<section class="page__section page__section--dark">
	<?= BlockPage::_('about') ?>
</section>

<section class="page__section padding-b2">
	<div class="page__cont">
		<h2>Клиенты компании <b>«ИнвестКапиталСтрой»</b> лидеры в своих отраслях</h2>
		<?= BlockClient::front() ?>
	</div>
</section>

<section class="page__section page__section--light padding-b3">
	<div class="page__cont page__cont--fluid">
		<h2>Мы открыты для сотрудничества со всеми организациями в <b>Сибирском регионе РФ</b></h2>
		<h3>Города, в которых велось строительство</h3>
		
		<?= BlockPartner::front() ?>
	</div>
</section>

<section class="page__section padding-b2">
	<div class="page__cont">
		<?= BlockNews::front('Последние новости') ?>
	</div>
</section>