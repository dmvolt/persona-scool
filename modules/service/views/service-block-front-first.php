<?php
use yii\helpers\Html;
use app\components\helpers\Text;
use app\modules\file\components\Img;
?>
<section class="padT80 padB30">
	<div class="container">
		<div class="row">
			<?php if($services):?>
				<?php foreach($services as $item):?>
				
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
						</div>
					</div>
			
				<?php endforeach;?>
			<?php endif;?>
		</div>
	</div>
</section>