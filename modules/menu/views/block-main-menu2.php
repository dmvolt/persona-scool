<?php
use yii\helpers\Html;

//$pathArr = explode('/', Yii::$app->getRequest()->getPathInfo());
				
?>
<?php if ($menu): ?>
	<?php foreach($menu as $key => $item): ?>
		<?php //$urlArr = explode('/', $item['parent']->url); ?>
		
		<li class="nav__item nav__item--<?= $item['parent']->icon ?><?php if('/'.Yii::$app->getRequest()->getPathInfo() == $item['parent']->url): ?> nav__item--active<?php endif; ?>">
			<div class="nav__item-icon">
				<img src="/img/nav__icon.svg" alt="" class="js-svg nav__icon-bg">
				
				<?php if ($item['parent']->url == '/services'): ?>
					<img src="/img/mob-serv.svg" alt="" class="js-svg nav__icon-img">
				<?php else: ?>
					<img src="/img/nav__plus.svg" alt="" class="js-svg nav__icon-img">
				<?php endif; ?>
			</div>

			<a href="<?php if ($item['parent']->url == '/services'): ?>#<?php else: ?><?= $item['parent']->url ?><?php endif; ?>" class="nav__link"><?= $item['parent']->title ?></a>
			<img src="/img/nav__item.svg" alt="" class="js-svg nav__item-bg">
			
			<?php if ($item['child']): ?>
				<ul class="nav__list nav__list--sub">
					<?php foreach($item['child'] as $child_item): ?>
					
						<li class="nav__item">
							<a href="<?= $child_item->url ?>" class="nav__link"><?= $child_item->title ?></a>
							<img src="/img/nav__item.svg" alt="" class="js-svg nav__item-bg">
						</li>
					
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>

			<?php if (isset($item['parent']->label) && $item['parent']->label != ''): ?>
				<div class="nav__item-label">
					<img src="/img/nav__<?= $item['parent']->label ?>.svg" alt="">
				</div>
			<?php endif; ?>
		</li>

	<?php endforeach; ?>
<?php endif; ?>