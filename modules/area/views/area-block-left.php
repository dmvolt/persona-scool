<?php
use yii\helpers\Html;
?>
<?php if ($areas): ?>
	<h2 class="header-aside"><a href="/areas"><img src="/img/areas.svg" class="icon icon--big js-svg"> <?= Html::encode($titleBlock) ?></a></h2>
	<ul class="catalog-menu text-small">
		<?php foreach($areas as $item): ?>
		
			<li class="catalog-menu__item">
				<a href="/areas/<?= $item->alias ?>" class="catalog-menu__link"><?= $item->short_title ?></a>
			</li>

		<?php endforeach; ?>
	</ul>
		<a href='/areas'>Все участки</a>
<?php endif; ?>