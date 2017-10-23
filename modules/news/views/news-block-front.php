<?php
use yii\helpers\Html;
use app\modules\file\components\Img;
use app\components\helpers\Text;
?>
<?php if ($news): ?>
	<h2><?= Html::encode($titleBlock) ?></h2>
	<div class="flex flex--gap-05 flex--vgap-1 padding-t1 padding-b1">
		<?php foreach($news as $item): ?>
			<div class="flex__item flex__item--4 flex__item--sm--12">
				<!-- block card start -->
				<div class="card">
				
					<?= Text::_edit($item->id, 'news') ?> <!-- Ссылка на редактирование материала -->
					
					<?php if($item->thumb):?>
						<a href="/news/<?= $item->alias ?>" class="card__preview">
							<div class="pic">
								<img src="<?= Img::_('news', $item->id, '500x150', $item->thumb->filename) ?>" class="pic__img">
							</div>
						</a>
					<?php endif; ?>

					<div class="card__content">
						<h3 class="card__header"><a href="/news/<?= $item->alias ?>"><?= $item->title ?></a></h3>
						<div class="card__date"><?= Text::_date($item->date, '.', ' ', '')?></div>

						<div class="card__text">
							<?= $item->teaser ?>
						</div>

						<div class="card__more">
							<a href="/news/<?= $item->alias ?>" class="button button--more">Подробнее</a>
						</div>
					</div>
				</div>
				<!-- block card end -->
			</div>
		<?php endforeach; ?>
	</div>
	<a href="/news" class="button">Больше новостей</a>
<?php endif; ?>