<?php
use yii\helpers\Html;
use app\components\helpers\Text;
?>
<?php if ($block && !empty($block->body)): ?>
	<?//= Text::_edit($block->id, 'infoblock') ?> <!-- Ссылка на редактирование материала -->
	<?= $block->body ?>			
	
<?php elseif($block && empty($block->body)): ?>
	<?//= Text::_edit($block->id, 'infoblock') ?> <!-- Ссылка на редактирование материала -->
	<?= $block->title ?>	
<?php endif; ?>