<?php
use yii\helpers\Html;
use app\modules\review\Module;
use app\components\widgets\Breadcrumbs;

use app\components\widgets\LinkPager;
use app\modules\infoblock\components\BlockText;
use app\modules\review\components\BlockReview;

$this->params['breadcrumbs'][] = $this->title;
$this->params['page_class'] = 'page-feedback';
?>
<section class="section">
	<header class="section__header section__header--top">
		<div class="container">
			<h2 class="header-top"><?= Html::encode($this->title) ?></h2>
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
					
					<?php if ($reviews): ?>
						<?php foreach($reviews as $item): ?>
							<div class="brief">
								<h3 class="text-up"><?= $item->title ?></h3>
								<div class="text-up opacity-50 text-small"><?= $item->position ?></div>
								<?= $item->body ?>
								<div class="brief__more"></div>
							</div>
						<?php endforeach; ?>	

						<?= LinkPager::widget([
							'pagination' => $pagination,
						]); ?>
						
					<?php else: ?>
						<h2>Извините, в этом разделе пока нет материалов.</h2>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>