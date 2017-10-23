<?php
use yii\helpers\Html;
$pathArr = explode('/', Yii::$app->getRequest()->getPathInfo());
?>
<?php if ($menu): ?>
	<ul class="menu__list">
		<?php foreach($menu as $item): ?>
			<?php //$urlArr = explode('/', $item->url); ?>
			<li class="menu__item<?php if('/'.$pathArr[0] == $item['parent']->url): ?> active<?php endif; ?>">
				<a href="<?= $item['parent']->url ?>" class="menu__link">
					<?= $item['parent']->title ?>
				</a>
			</li>
			<?php if ($item['child']): ?>
				<?php foreach($item['child'] as $child_item): ?>
					<li class="menu__item"><a href="<?= $child_item->url ?>" class="menu__link"><?= $child_item->title ?></a></li>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>