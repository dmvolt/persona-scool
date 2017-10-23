<?php

use yii\helpers\Html;
use app\modules\article\Module;
use app\modules\file\components\Img;
use app\components\helpers\Text;

use app\modules\news\components\BlockNews;
use app\modules\magazine\components\BlockMagazine;

use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = ['label' => $this->params['title_module'], 'url' => ['index']];
$this->params['breadcrumbs'][] = $article->title;
$this->params['page_class'] = 'page-articles-page';
?>
<section class="section">
	<header class="section__header section__header--top">
		<div class="container">
			<h2 class="header-top"><?= Html::encode($this->params['title_module']) ?></h2>
		</div>
	</header>

	<div class="section__content">
		<div class="container">
			<div class="flex">
				<aside class="flex__item flex__item--30 aside">
					<div class="aside__block aside__block--magazine">
						<?= BlockNews::left('Новости',4) ?> 
					</div>

					<div class="aside__block aside__block--magazine">
						<?= BlockMagazine::left('скачать ЖУРНАЛ «РОСЭНЕРГОРЕСУРС»', 4) ?> <!-- Журналы -->
					</div>
				</aside>
				<div class="flex__item flex__item--90">

					<!-- block breadcrumbs start -->
					<?= Breadcrumbs::widget([
						'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
					]) ?>
					<!-- block breadcrumbs end -->

					<h1><?= $this->params['title_h1'] ?></h1>
					
					<article class="article">
						<?= Text::_edit($article->id, 'article') ?> <!-- Ссылка на редактирование материала -->
						<?= $article->body ?>
						
						<h5 class="sharesocial">Поделиться:</h5>
						<script type="text/javascript">(function(w,doc) {
						if (!w.__utlWdgt ) {
						    w.__utlWdgt = true;
						    var d = doc, s = d.createElement('script'), g = 'getElementsByTagName';
						    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
						    s.src = ('https:' == w.location.protocol ? 'https' : 'http')  + '://w.uptolike.com/widgets/v1/uptolike.js';
						    var h=d[g]('body')[0];
						    h.appendChild(s);
						}})(window,document);
						</script>
						<div 
							data-background-alpha="0.0" 
							data-buttons-color="#ffffff" 
							data-counter-background-color="#ffffff" 
							data-share-counter-size="12" 
							data-top-button="false" 
							data-share-counter-type="common" 
							data-share-style="1" 
							data-mode="share" 
							data-like-text-enable="false" 
							data-hover-effect="rotate-cw" 
							data-mobile-view="false" 
							data-icon-color="#ffffff" 
							data-orientation="horizontal" 
							data-text-color="#000000" 
							data-share-shape="rectangle" 
							data-sn-ids="vk.ok.mr.fb.tw.gp." 
							data-share-size="30" 
							data-background-color="#ffffff" 
							data-preview-mobile="false" 
							data-mobile-sn-ids="fb.vk.tw.wh.ok.gp." 
							data-pid="1429788" 
							data-counter-background-alpha="1.0" 
							data-following-enable="false" 
							data-exclude-show-more="true" 
							data-selection-enable="false" 
							class="uptolike-buttons" >
						</div>
					</article>
				</div>
			</div>
		</div>
	</div>
</section>