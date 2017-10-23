<?php
use yii\helpers\Html;
use app\modules\file\components\Img;
?>
<?php if ($clients): ?>
	<div class="text-center">
		<?php foreach($clients as $item): ?>
			<?php if($item->thumb):?>
				<?php if(!empty($item->alias)):?>
					<a href="<?= $item->alias ?>" target="_blank" class="logo-link"><img src="<?= Img::_('client', $item->id, '160x80', $item->thumb->filename) ?>" alt="<?= $item->title ?>"></a>
				<?php else:?>
					<div class="logo-link"><img src="<?= Img::_('client', $item->id, '160x80', $item->thumb->filename) ?>" alt="<?= $item->title ?>"></div>
				<?php endif; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>