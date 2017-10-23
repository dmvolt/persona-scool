<?php
use yii\helpers\Html;
use app\components\helpers\Text;
use app\modules\page\Module;
use app\modules\file\components\Img;
use app\components\widgets\Breadcrumbs;

use app\modules\main\components\BlockForm;
use app\modules\infoblock\components\BlockText;

$this->params['breadcrumbs'][] = $this->title;
$this->params['page_class'] = 'page--article';
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
		<h1><?= Html::encode($page->title) ?></h1>
		<hr>
	</div>
</section>

<section class="page__section">
	<div class="page__cont padding-b2">
	
		<?php if($page->alias == 'contacts'):?>
			<div class="flex flex--gap-05">
				<div class="flex__item flex__item--6 flex__item--sm--12">
					<?= Text::_edit($page->id, 'page') ?> <!-- Ссылка на редактирование материала -->
					<article class="article">
						<?= $page->teaser ?>
					</article>
				</div>
				<div class="flex__item flex__item--6 flex__item--sm--12">
					<article class="article">
						<?= $page->body ?>
					</article>
				</div>
				<div class="flex__item flex__item--12">
					<h3 class="text-left">Схема проезда</h3>
					<hr>
					<?= $this->params['siteinfo']->map ?>
				</div>
				
				<div class="flex__item flex__item--12">
					<h3 class="text-left">Написать нам</h3>
					<hr>
					<?= BlockForm::_contact() ?>
				</div>
			</div>
		<?php else: ?>				
						
			<!-- block article start -->
			<article class="article">
				<?= Text::_edit($page->id, 'page') ?> <!-- Ссылка на редактирование материала -->
				<?= $page->body ?>
			</article>
			<!-- block article end -->
		<?php endif; ?>
	</div>
</section>