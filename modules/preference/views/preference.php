<?php

use yii\helpers\Html;
use app\modules\preference\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;
use app\modules\main\components\BlockForm;

use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = ['label' => 'Преимущества', 'url' => ['index']];
$this->params['breadcrumbs'][] = $preference->title;
$this->params['page_class'] = 'page-news-page';
?>
<section class="cont">
	<?= Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
</section>