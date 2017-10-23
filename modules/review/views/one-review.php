<?php
use yii\helpers\Html;
use app\components\widgets\Breadcrumbs;
use app\modules\review\components\BlockReview;
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $review->title;
$this->params['page_class'] = 'page-feedback';
?>
<section class="section">
	<header class="section__header section__header--top">
		<div class="container">
			<h2 class="header-top"><?= Html::encode($review->title) ?></h2>
		</div>
	</header>
	<div class="section__content">
		<div class="container">
			<div class="flex">
				<aside class="flex__item flex__item--30 aside">
					<div class="aside__block aside__block--article">
						<h2 class="header-aside"><img src="/img/feedback.svg" class="icon icon--big js-svg"> Оставить отзыв</h2>
						<?= BlockReview::_form() ?>
					</div>
				</aside>
				<div class="flex__item flex__item--90">
					<!-- block breadcrumbs start -->
					<?= Breadcrumbs::widget([
						'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
					]) ?>
					<!-- block breadcrumbs end -->
					
					<article class="article">
						<h3 class="text-up"><?= $review->title ?></h3>
						<div class="text-up opacity-50 text-small"><?= $review->position ?></div>
						<?= $review->body ?>
					</article>
				</div>
			</div>
		</div>
	</div>
</section>