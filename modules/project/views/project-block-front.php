<?php
use yii\helpers\Html;
use app\modules\file\components\Img;
?>
<?php if ($projects): ?>
	<div class="flex flex--center">
		<?php foreach($projects as $item): ?>
			<div class="flex__item flex__item--4 flex__item--md--6 flex__item--xs--12">
				<div class="box">
					<?php if($item->thumb):?>
						<div class="box__bg" style="background-image: url(<?= Img::_('project', $item->id, '959x600', $item->thumb->filename) ?>);"></div>
					<?php else: ?>
						<div class="box__bg" style="background-image: url(/img/bgl.jpg);"></div>
					<?php endif; ?>
					
					<a href="/objects/<?= $item->alias ?>" class="box__content box__content--hover">
						<article class="article">
							<h3><?= $item->short_title ?></h3>
							<?= $item->teaser ?>
						</article>
					</a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<a href="/objects" class="button">Все объекты</a>
<?php endif; ?>