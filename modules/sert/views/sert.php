<?php

use yii\helpers\Html;
use app\modules\sert\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;

$this->params['breadcrumbs'][] = ['label' => 'Сертификаты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $sert->title;
$this->params['page_class'] = 'page-action';
?>
<section class="cont">
	<h1 class="h-main"><?= Html::encode($sert->title) ?></h1>
</section>
<section class="cont">
	<article class="article">
		<?= Text::_edit($sert->id, 'sert') ?> <!-- Ссылка на редактирование материала -->
		<?php //if($sert->thumb):?>
			<!--<img src="<?//= Img::_(Module::getInstance()->imagesDirectory, $sert->id, 'middle', $sert->thumb->filename) ?>" alt="" class="sert__left">-->	<!-- 400X -->
		<?php //endif; ?>

		<?= $sert->body ?>
	</article>
</section>
