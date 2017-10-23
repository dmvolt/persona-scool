<?php
use yii\helpers\Html;
?>
<?php if ($newss): ?>
	<h2 class="header-aside"><a href="/newss"><img src="/img/newss.svg" class="icon icon--big js-svg"> <?= Html::encode($titleBlock) ?></a></h2>
	<ul class="catalog-menu text-small">
		<?php foreach($newss as $item): ?>
		
			<li class="catalog-menu__item">
				<a href="/newss/<?= $item->alias ?>" class="catalog-menu__link"><?= $item->short_title ?></a>
			</li>

		<?php endforeach; ?>
	</ul>
		<a href='/newss'>Все новости</a>
<?php endif; ?>