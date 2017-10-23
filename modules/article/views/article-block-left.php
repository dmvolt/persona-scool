<?php
use yii\helpers\Html;
?>
<?php if ($articles): ?>
	<h2 class="header-aside"><a href="/articles"><img src="/img/articles.svg" class="icon icon--big js-svg"> <?= Html::encode($titleBlock) ?></a></h2>
	<ul class="catalog-menu text-small">
		<?php foreach($articles as $item): ?>
		
			<li class="catalog-menu__item">
				<a href="/articles/<?= $item->alias ?>" class="catalog-menu__link"><?= $item->short_title ?></a>
			</li>

		<?php endforeach; ?>
	</ul>
		<a href='/articles'>Все статьи</a>
<?php endif; ?>