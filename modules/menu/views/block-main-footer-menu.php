<?php
use yii\helpers\Html;			
?>
<?php if ($menu): ?>
	<?php foreach($menu as $key => $item): ?>
		
		<li><a href="<?= $item->url ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i><?= $item->title ?></a></li>
	
	<?php endforeach; ?>
<?php endif; ?>