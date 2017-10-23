<?php
use yii\helpers\Html;		
?>
<?php if ($menu): ?>
	<?php foreach($menu as $item): ?>
		<a href="<?= $item->url ?>" target="_blank" title="<?= $item->title ?>" class="social-link"><i class="fa fa-<?= $item->icon ?>"></i></a>
	<?php endforeach; ?>
<?php endif; ?>
