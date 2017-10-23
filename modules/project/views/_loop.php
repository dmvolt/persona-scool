<?php
use yii\helpers\Html;
use app\modules\project\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;
?>
<?php if($projects):?>
	<?php foreach($projects as $item):?>
		<div class="flex__item flex__item--4 flex__item--sm--12">
			<!-- block card start -->
			<div class="card">
			
				<?= Text::_edit($item->id, 'project') ?> <!-- Ссылка на редактирование материала -->
				
				<?php if($item->thumb):?>
					<a href="/objects/<?= $item->alias ?>" class="card__preview">
						<div class="pic">
							<img src="<?= Img::_(Module::getInstance()->imagesDirectory, $item->id, '500x150', $item->thumb->filename) ?>" class="pic__img">
						</div>
					</a>
				<?php endif; ?>

				<div class="card__content">
					<h3 class="card__header"><a href="/objects/<?= $item->alias ?>"><?= Text::_date($item->date, '.', ' ', '')?> <?= $item->title ?></a></h3>
					
					<div class="card__text">
						<?= $item->teaser ?>
					</div>

					<div class="card__more">
						<a href="/objects/<?= $item->alias ?>" class="button button--more">Подробнее</a>
					</div>
				</div>
			</div>
			<!-- block card end -->
		</div>
	<?php endforeach;?>
<?php endif;?>