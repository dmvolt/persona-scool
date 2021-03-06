<?php
use yii\helpers\Html;
use app\modules\file\components\Img;
?>
<?php if ($areas): ?>
	<div class="row">
		<h2><?= Html::encode($titleBlock) ?></h2>
		<hr>
		<?php foreach($areas as $item): ?>
			<div class="col-lg-4">
				<?php if($item->thumb):?>
					<a href="/areas/<?= $item->alias ?>"><img src="<?= Img::_('area', $item->id, 'thumbnail', $item->thumb->filename) ?>" style="float:left;margin:0 15px 15px 0;"></a>
				<?php endif; ?>
				<h3><a href="/areas/<?= $item->alias ?>"><?= $item->short_title ?></a></h3>
				<?= $item->teaser ?>
				<a href="/areas/<?= $item->alias ?>">Подробнее</a>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>