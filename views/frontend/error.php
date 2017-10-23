<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

use app\modules\file\components\Img;
use app\modules\menu\components\BlockMenu;

AppAsset::register($this);
use app\modules\infoblock\components\BlockText;

$this->title = $message;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<meta name="description" content="<?= $this->params['meta_description'] ?>">
	<meta name="keywords" content="<?= $this->params['meta_keywords'] ?>">

	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>

	<!-- favicons -->
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	<!-- favicons -->

	<?php $this->head() ?>
</head>

<body class="page page--error">

	<?php $this->beginBody() ?>
	<?= $this->params['siteinfo']->counter ?>
	
	<!-- block side start -->
	<div id="page__side" class="page__side">
		<!-- block menu start -->
		<nav class="menu menu--vert">
			<?= BlockMenu::main(); ?>
		</nav>
		<!-- block menu end -->

		<div class="text-center padding-t1 padding-b1">
			<?= BlockMenu::social() ?>
		</div>
	</div>
	<!-- block side end -->
	
	<div id="page__panel" class="page__panel">
	
		<!--[if lt IE 9]>
			<div class="page__upgrade">Вы используете <strong>устаревший</strong> браузер. Пожалуйста <a href="https://browsehappy.com/" target="_blank">обновите ваш браузер</a> для улучшения отображения сайта.</div>
		<![endif]-->

		<main class="page__main">
			<section class="page__section">
				<div class="flex flex--center flex--vcenter flex--max">
					<div class="flex__item">
						<div class="page__cont padding-t2 padding-b2">
							<div class="text-center text-huge">
								<!-- block logo start -->
								<a href="<?= Yii::$app->homeUrl ?>" class="logo" data-scroll-goto="0">
									<img src="/img/logo.png" alt="logo" class="logo__img">
								</a>
								<!-- block logo end -->
								<?= Html::encode($message) ?>
								<?= BlockText::_('block_404') ?>
							</div>
							<a href="<?= Yii::$app->homeUrl ?>" class="button button--wide">Перейти на главную страницу</a>
						</div>
					</div>
				</div>
			</section>
		</main>
	</div>
	
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>	