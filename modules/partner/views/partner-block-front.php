<?php
use yii\helpers\Html;
use app\modules\file\components\Img;
?>
<?php if ($partners): ?>
	<div class="flex flex--center">
		<?php foreach($partners as $item): ?>

			<div class="flex__item flex__item--20p flex__item--lg--4 flex__item--sm--6 flex__item--xs--12 flex__item--city" >

				<?php if($item->thumb):?>
					<div class="pic" alt="<?= $item->title ?>">
						<?php if(!empty($item->alias)):?>
							<a href="<?= $item->alias ?>" target="_blank"><img src="<?= Img::_('partner', $item->id, '400x300', $item->thumb->filename) ?>" alt="<?= $item->title ?>" class="pic__img"></a>
						<?php else:?>
							<img src="<?= Img::_('partner', $item->id, '400x300', $item->thumb->filename) ?>" alt="<?= $item->title ?>" class="pic__img">
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

		<?php endforeach; ?>
	</div>
<?php endif; ?>
