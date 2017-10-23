<?php
use yii\helpers\Html;
use app\modules\news\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;

use app\components\widgets\LinkPager;
use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = $this->title;
$this->params['page_class'] = 'page--news';
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
		<?php if($news):?>
			<div class="flex flex--gap-05 flex--vgap-1 padding-t1 padding-b1">
				<?php foreach($news as $item):?>

					<div class="flex__item flex__item--4 flex__item--sm--12">
						<!-- block card start -->
						<div class="card">
						
							<?= Text::_edit($item->id, 'news') ?> <!-- Ссылка на редактирование материала -->
							
							<?php if($item->thumb):?>
								<a href="/news/<?= $item->alias ?>" class="card__preview">
									<div class="pic">
										<img src="<?= Img::_(Module::getInstance()->imagesDirectory, $item->id, '500x150', $item->thumb->filename) ?>" class="pic__img">
									</div>
								</a>
							<?php endif; ?>

							<div class="card__content">
								<h3 class="card__header"><a href="/news/<?= $item->alias ?>"><?= $item->title ?></a></h3>
								<div class="card__date"><?= Text::_date($item->date, '.', ' ', '')?></div>

								<div class="card__text">
									<?= $item->teaser ?>
								</div>

								<div class="card__more">
									<a href="/news/<?= $item->alias ?>" class="button button--more">Подробнее</a>
								</div>
							</div>
						</div>
						<!-- block card end -->
					</div>
				<?php endforeach;?>
			</div>

			<?= LinkPager::widget([
				'pagination' => $pagination,
			]); ?>		
					
		<?php endif;?>
	</div>
</section>