<?php

use yii\helpers\Html;
use app\modules\team\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;
use app\modules\infoblock\components\BlockText;
use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = $this->title;
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
						<h3 class="text-center theme-color"><?= Html::encode($this->title) ?></h3>
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
<section class="padT50 bagG">
	<?php if ($mainTeam): ?>
		<article class="article">
			<?= $mainTeam->body ?>
		</article>
	<?php endif; ?>

	<div class="container">
		<div class="row">
			<?php if ($teams): ?>
				<?php foreach($teams as $item): ?>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="theme-hover marB30">
							<?= Text::_edit($item->id, 'team') ?> <!-- Ссылка на редактирование материала -->
							<figure>
								<?php if($item->thumb):?>
									<img src="<?= Img::_(Module::getInstance()->imagesDirectory, $item->id, 'big-square', $item->thumb->filename) ?>" alt="">
								<?php endif; ?>
								
								<figcaption><a href="/team/<?= $item->alias ?>"><span class="icon basic-link"></span></a></figcaption>
							</figure>
							
							<div class="staff-details text-center padT20">
								<h4><a href="/team/<?= $item->alias ?>"><?= $item->title ?></a></h4>
								<p class="theme-color marB10"><?= $item->position ?></p>
								<?= $item->teaser ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<h2>Извините, в этом разделе пока нет материалов.</h2>
			<?php endif; ?>
		</div>
	</div>
</section>
<!--//================Our Staff end==============//-->
<div class="clear"></div>
<!--//================contact us starts==============//-->
<div class="padTB30 theme-bg contact-us">
	
</div>
<div class="clear"></div>