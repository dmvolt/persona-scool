<?php
use yii\helpers\Html;
use app\modules\file\components\Img;
use app\components\helpers\Text;
?>
<?php if ($teams): ?>
<h2 class="header-main"></h2>
<!--//================Our Staff starts==============//-->
<section class="padT50 padB50 bagG">
	<!--- Theme heading start-->
	<div class="theme-heading marB30 positionR">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-xs-10  col-md-offset-4 col-sm-offset-3 col-xs-offset-1 heading-box text-center">
					<h3 class="theme-color marB10"><?= Html::encode($titleBlock) ?></h3>
					<span class=" marB10"> <i class="fa fa-child" aria-hidden="true"></i> </span>
				</div>
			</div>
		</div>
	</div>
	<!--- Theme heading end-->
	<div class="container">
		<div class="row">
			<?php foreach($teams as $item): ?>
				
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="theme-hover marB30">
						<?= Text::_edit($item->id, 'team') ?> <!-- Ссылка на редактирование материала -->
						<figure>
							<?php if($item->thumb):?>
								<img src="<?= Img::_('team', $item->id, 'big-square', $item->thumb->filename) ?>" alt="">
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
		</div>
	</div>
</section>
<!--//================Our Staff end==============//-->
<?php endif; ?>