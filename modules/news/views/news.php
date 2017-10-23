<?php

use yii\helpers\Html;
use app\modules\news\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;

use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = ['label' => $this->params['title_module'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $news->title;
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
		<h1><?= $this->params['title_h1'] ?></h1>
		<hr>
		<div class="card__date"><?= Text::_date($news->date, '.', ' ', '')?></div>
	</div>
</section>

<section class="page__section">
	<div class="page__cont padding-b2">
		<div class="flex flex--gap-05">
			<?php if($news->thumb):?>
				<div class="flex__item flex__item--6 flex__item--sm--12">
					<article class="article">
						<?= Text::_edit($news->id, 'news') ?> <!-- Ссылка на редактирование материала -->
						<?= $news->body ?>
					</article>
				</div>
				<div class="flex__item flex__item--6 flex__item--sm--12 flex__item--sm--start">
					<img src="<?= Img::_(Module::getInstance()->imagesDirectory, $news->id, '600x300', $news->thumb->filename) ?>" class="img-caption">
				</div>
			<?php else: ?>
				<div class="flex__item flex__item--12 flex__item--sm--12">
					<article class="article">
						<?= Text::_edit($news->id, 'news') ?> <!-- Ссылка на редактирование материала -->
						<?= $news->body ?>
					</article>
				</div>
			<?php endif; ?>
		</div>
		<a href="/news" class="button">Все новости</a>
	</div>
</section>