<?php
use yii\helpers\Html;

use app\modules\file\components\Img;

use app\modules\infoblock\components\BlockText;
use app\modules\main\components\BlockForm;

use app\components\widgets\LinkPager;
use app\components\widgets\Breadcrumbs;

use app\components\helpers\Text;

$this->params['breadcrumbs'][] = $this->title;
$this->params['page_class'] = 'page-news';
?>

<section class="cont">
	<?= Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>

	<?php if ($search && !empty($search)): ?>
	
		<h1><?= Html::encode($this->title) ?></h1>
		
		<?php foreach($search as $moduleTitle => $content): ?>
			<div class="cont__maw-1200 news">
			
				<h2><?= Html::encode($moduleTitle) ?></h2>

				<?php foreach($content['content'] as $item): ?>
					<div class="news__item clearfix">
						<?php if($item->thumb):?>
							<a href="<?= $content['link'] ?><?php if($content['is_id']): ?><?= $item->id ?><?php else: ?><?= $item->alias ?><?php endif; ?>" class="news__preview"><img src="<?= Img::_($content['module'], $item->id, 'middle-square', $item->thumb->filename) ?>"></a> <!-- 230X230 -->
						<?php endif; ?>
						
						<h2 class="news__header"><a href="<?= $content['link'] ?><?php if($content['is_id']): ?><?= $item->id ?><?php else: ?><?= $item->alias ?><?php endif; ?>"><?= $item->title ?></a></h2>
						<?php if($content['is_date']): ?><div class="date"><?= Text::_date($item->date, '.', ' ', ' г.')?></div><?php endif; ?>
						<?= $item->teaser ?>
						<a href="<?= $content['link'] ?><?php if($content['is_id']): ?><?= $item->id ?><?php else: ?><?= $item->alias ?><?php endif; ?>">подробнее</a>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	<?php else: ?>
		<h2>Извините, по Вашему запросу ничего не найдено. Попробуйте уточнить искомое слово(а).</h2>
	<?php endif; ?>
</section>

<section class="cont">
	<?//= LinkPager::widget([
	//	'pagination' => $pagination,
	//	'options' => ['class' => 'pagination'],
	//	'prevPageCssClass' => 'pagination__prev',
	//	'nextPageCssClass' => 'pagination__next',
	//	'nextPageLabel' => '',
	//	'prevPageLabel' => '',
	//]); ?>
</section>

<section class="bg-light">
	<div class="cont">
		<?= BlockForm::_consult() ?>
	</div>
</section>