<?php
use yii\helpers\Html;
use app\modules\preference\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;
use app\modules\main\components\BlockForm;

use app\components\widgets\LinkPager;
use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = $this->title;
$this->params['page_class'] = 'page-news';
?>

<section class="cont">
	<?= Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
	
	<?php if ($preferences): ?>
		
	<?php else: ?>
		<h2>Извините, в этом разделе пока нет материалов.</h2>
	<?php endif; ?>
</section>