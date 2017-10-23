<?php
use yii\helpers\Html;
use app\modules\team\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;
?>
<?php if ($teams): ?>	
	<?php foreach($teams as $item): ?>
		<div class="product">
			<?php if($item->thumb):?>
				<a href="/team/<?= $item->alias ?>" class="convex">
					<div class="convex__gor">
						<div class="convex__vert">
							<img src="<?= Img::_(Module::getInstance()->imagesDirectory, $item->id, 'middle-square', $item->thumb->filename) ?>" alt="">
						</div>
					</div>
				</a>
			<?php endif; ?>
			
			<div class="product__content">
				<?= Text::_edit($item->id, 'team') ?> <!-- Ссылка на редактирование материала -->
				<a href="/team/<?= $item->alias ?>"><?= $item->title ?></a><br>
				<p><?= $item->position ?></p>
				
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>