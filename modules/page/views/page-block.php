<?php
use app\modules\file\components\Img;
?>
<div class="flex">
	<?php if($block->thumb):?>
		<div class="flex__item flex__item--6 display--sm-n" style="background-image: url(<?= Img::_('page', $block->id, '959x600', $block->thumb->filename) ?>);"></div>
	<?php else: ?>
		<div class="flex__item flex__item--6 flex__item-bg-left display--sm-n"></div>
	<?php endif; ?>
	
	<div class="flex__item flex__item--6 flex__item--sm--12 flex__item-bg-right padding-b2">
		<div class="page__cont">
		<article class="article">
			<?= $block->teaser ?>
			<a href="/<?= $block->alias ?>" class="button button--more"><?= $block->title ?></a>
		</article>
		</div>
	</div>
</div>