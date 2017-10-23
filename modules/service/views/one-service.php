<?php
use yii\helpers\Html;
use app\modules\service\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;

use app\modules\infoblock\components\BlockText;
use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = $this->title;
$this->params['page_class'] = 'page-one-service';
?>
<div class="clear"></div>
<!--//================Breadcrumb starts==============//-->
<section>
	<div class="bredcrumb-section padTB100 positionR">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="theme-heading text-center">
						<h3 class="text-center theme-color"><?= Html::encode($service->title) ?></h3>
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
<!--//================About us starts==============//-->

<section class="padT80 padB50">
	<div class="container">
		<?= Text::_edit($service->id, 'service') ?> <!-- Ссылка на редактирование материала -->
		<?= $service->body ?>
	</div>
</section>

<!--//================About us end==============//-->
<div class="clear"></div>
<!--//================contact us starts==============//-->
<div class="padTB30 theme-bg contact-us">
	<div class="container">
		<div class="row">
			<div class="col-md-9 col-sm-9 col-xs-12">
				<p class="colorW text-left special-font mar0">Найти нас очень легко</p>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<a href="/contacts" class="itg-button-simple pull-right small-left">Контакты</a>
			</div>
		</div>
	</div>
</div>
<!--//================contact us end==============//-->
<div class="clear"></div>