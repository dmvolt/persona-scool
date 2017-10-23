<?php

use yii\helpers\Html;
use app\modules\team\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;
use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = ['label' => $this->params['title_module'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $team->title;

$this->params['page_class'] = 'page-team';
?>
<div class="clear"></div>
<!--//================Breadcrumb starts==============//-->
<section>
	<div class="bredcrumb-section padTB100 positionR">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="theme-heading text-center">
						<h3 class="text-center theme-color"><?= Html::encode($this->params['title_module']) ?></h3>
						<span class="colorW marB10"> <i class="fa fa-child" aria-hidden="true"></i> </span>
					</div>
					<!-- block breadcrumbs start -->
					<?= Breadcrumbs::widget([
						'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
					]) ?>
					<!-- block breadcrumbs end -->
				</div>
			</div>
		</div>
	</div>
</section>
<!--//================Breadcrumb end==============//-->
<div class="clear"></div>
<!--//================Teacher starts==============//-->
<section class="padT80 padB50">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<?php if($team->thumb):?>
					<figure class="marB30">
						<img src="<?= Img::_(Module::getInstance()->imagesDirectory, $team->id, 'big-square', $team->thumb->filename) ?>" alt="<?= $team->title?>" title="<?= $team->title?>">
					</figure>
				<?php endif; ?>
			</div>
			<div class="col-md-8 col-sm-6 col-xs-12">
				<div class="teacher-details marB30">
					<?= Text::_edit($team->id, 'team') ?> <!-- Ссылка на редактирование материала -->
					<h3 class="text-left"><?= $team->title ?></h3>
					<p class="marB10 special-para text-left"><?= $team->position ?></p>
					<?= $team->body ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!--//================Teacher end==============//-->
<div class="clear"></div>
<!--//================contact us starts==============//-->
<div class="padTB30 theme-bg contact-us">
	
</div>
<div class="clear"></div>