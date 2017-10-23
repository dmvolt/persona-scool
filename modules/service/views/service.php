<?php
use yii\helpers\Html;
use app\modules\service\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;

use app\components\widgets\LinkPager;
use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = $this->title;
$this->params['page_class'] = 'page-service';
?>
<div class="clear"></div>
<!--//================Breadcrumb starts==============//-->
<section>
	<div class="bredcrumb-section padTB100 positionR">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="theme-heading text-center">
						<h3 class="text-center theme-color"><?= Html::encode($this->params['title_h1']) ?></h3>
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
<!--//================Blogs starts==============//-->
<section class="padT80 padB30">
	<div class="container">
		<div class="row">
			<?php if($articles):?>
				<?php foreach($articles as $item):?>
				
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="blog-img marB30">
							<?php if($item->thumb):?>
								<figure>
									<a href="/services/<?= $item->alias ?>"><img src="<?= Img::_('service', $item->id, '360x180', $item->thumb->filename) ?>" alt=""></a>
								</figure>
							<?php endif; ?>
						</div>
						<div class="blog-detail marB50">
							<?= Text::_edit($item->id, 'service') ?> <!-- Ссылка на редактирование материала -->
							<h4 class="colorB marB10 title text-left"><a href="/services/<?= $item->alias ?>"><?= $item->title ?></a></h4>
							
							<?= $item->teaser ?>
							<p class="marB10 text-left"><a href="/services/<?= $item->alias ?>">Узнать подробнее<i class="fa fa-angle-double-right marL10" aria-hidden="true"></i></a></p>
						</div>
					</div>
			
				<?php endforeach;?>
				
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="pagination-box text-right marB50">
						<?= LinkPager::widget([
							'pagination' => $pagination,
						]); ?>
					</div>
				</div>
			<?php endif;?>
		</div>
	</div>
</section>
<!--//================Blogs end==============//-->
<div class="clear"></div>
<!--//================contact us starts==============//-->
<div class="padTB30 theme-bg contact-us">
	
</div>
<div class="clear"></div>