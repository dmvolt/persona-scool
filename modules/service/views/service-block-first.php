<?php
use yii\helpers\Html;
use app\components\helpers\Text;
?>
<?php if ($services): ?>
	<div class="flex">
		<?php foreach($services as $value): ?>
			<div class="flex__item flex__item--3">
				<div class="branch__item branch__item_<?= $value->color ?>">
					<a href="/services/<?= $value->alias ?>" class="branch__item__header"><?= $value->title ?></a>
					<div class="branch__item__text">
						<?= $value->teaser ?>
					</div>
					<a href="/services/<?= $value->alias ?>" class="branch__item__more branch__show">узнать больше</a>
				</div>
			</div>
		<?php endforeach; ?>		
	</div>
<?php endif; ?>