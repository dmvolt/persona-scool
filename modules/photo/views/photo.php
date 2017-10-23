<?php
use yii\helpers\Html;
use app\components\helpers\Text;
use app\modules\photo\Module;
use app\modules\file\components\Img;
use app\components\widgets\Breadcrumbs;

use app\modules\infoblock\components\BlockText;

$this->params['breadcrumbs'][] = $this->title;
$this->params['photo_class'] = 'photo';
?>
<div class="clear"></div>
<!--//================Breadcrumb starts==============//-->
<section>
	<div class="bredcrumb-section padTB100 positionR">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="theme-heading text-center">
						<h3 class="text-center theme-color"><?= Html::encode($photo->title) ?></h3>
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
		<?= Text::_edit($photo->id, 'photo') ?> <!-- Ссылка на редактирование материала -->
		<?= $photo->body ?>
	</div>
</section>

<!--//================About us end==============//-->
<div class="clear"></div>
<!--//================contact us starts==============//-->
<div class="padTB30 theme-bg contact-us">
	
</div>
<!--//================contact us end==============//-->
<div class="clear"></div>