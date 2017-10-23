<?php
use yii\helpers\Html;
use app\modules\file\components\Img;
use app\components\helpers\Text;
?>
<?php if ($services): ?>
	<div class="flex">
		<?php foreach($services as $value): ?>
			<?php if (!$value->children): ?>
				<div class="flex__item flex__item--3">
					<div class="service">
						<h4 class="service__header"><a href="/services/<?= $value->alias ?>"><?= $value->title ?></a></h4>
						
						<?php if($value->thumb):?>
							<a href="/services/<?= $value->alias ?>"><img class="service__picture" src="<?= Img::_('service', $value->id, 'middle-square', $value->thumb->filename) ?>"></a>
						<?php endif; ?>
						
						<div class="service__text">
							<?= $value->teaser ?>
						</div>
						<a href="/services/<?= $value->alias ?>" class="service__more">узнать больше</a>
					</div>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>