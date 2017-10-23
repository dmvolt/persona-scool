<?php
use yii\helpers\Html;
use app\modules\article\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;

use app\components\widgets\LinkPager;

use app\modules\news\components\BlockNews;
use app\modules\magazine\components\BlockMagazine;

use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = $this->title;
$this->params['page_class'] = 'page-articles';
?>
<section class="section">
	<header class="section__header section__header--top">
		<div class="container">
			<h2 class="header-top"><?= Html::encode($this->params['title_h1']) ?></h2>
		</div>
	</header>

	<div class="section__content">
		<div class="container">
			<div class="flex">
				<aside class="flex__item flex__item--30 aside">
					<div class="aside__block aside__block--magazine">
						<?= BlockNews::left('Новости',4) ?> 
					</div>

					<div class="aside__block aside__block--magazine">
						<?= BlockMagazine::left('скачать ЖУРНАЛ «РОСЭНЕРГОРЕСУРС»', 4) ?> <!-- Журналы -->
					</div>
				</aside>
				<div class="flex__item flex__item--90">

					<!-- block breadcrumbs start -->
					<?= Breadcrumbs::widget([
						'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
					]) ?>
					<!-- block breadcrumbs end -->

					<?php if($articles):?>
						<?php foreach($articles as $item):?>
							<div class="brief">
								<?= Text::_edit($item->id, 'article') ?> <!-- Ссылка на редактирование материала -->
								<h3 class="header-link"><a href="/articles/<?= $item->alias ?>"><?= $item->title ?></a></h3>
								<?= $item->teaser ?>
								<div class="brief__more">
									<a href="/articles/<?= $item->alias ?>">подробнее <img src="/img/arrow.svg" class="icon js-svg"></a>
								</div>
							</div>
						<?php endforeach;?>
						
						<?= LinkPager::widget([
							'pagination' => $pagination,
						]); ?>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</section>