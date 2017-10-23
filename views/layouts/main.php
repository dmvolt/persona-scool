<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

//use app\components\widgets\Alert;

use app\modules\menu\components\BlockMenu;

AppAsset::register($this);

$mainMenu = BlockMenu::main();
$socialMenu = BlockMenu::social();
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

	<!-- vk -->
	<link rel="image_src" href="http://sitename.ru/share-big.png">
	<!-- vk -->

	<!-- opengraph  -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="http://sitename.ru">
	<meta property="og:locale" content="ru_RU">
	<meta property="og:title" content="index">
	<meta property="og:site_name" content="sitename.ru">
	<meta property="og:description" content="description">
	<meta property="og:image" content="http://sitename.ru/share-big.png">
	<meta property="og:image" content="http://sitename.ru/share-small.png">
	<!-- opengraph  -->

	<?php $this->head() ?>
</head>

<body class="page <?= $this->params['page_class'] ?>">

	<?php $this->beginBody() ?>

	<?= $this->params['siteinfo']->counter ?>
	
	<!-- block side start -->
	<div id="page__side" class="page__side">
		<!-- block menu start -->
		<nav class="menu menu--vert">
			<?= $mainMenu ?>
		</nav>
		<!-- block menu end -->

		<div class="text-center padding-t1 padding-b1">
			<?= $socialMenu ?>
		</div>
	</div>
	<!-- block side end -->
	
	<div id="page__panel" class="page__panel">
	
		<!--[if lt IE 9]>
			<div class="page__upgrade">Вы используете <strong>устаревший</strong> браузер. Пожалуйста <a href="https://browsehappy.com/" target="_blank">обновите ваш браузер</a> для улучшения отображения сайта.</div>
		<![endif]-->

		<!-- block header start -->
		<header class="page__header page__header--top">
			<section class="page__section">
				<div class="page__cont">
					<div class="flex flex--vcenter flex--gap-05 padding-t05 padding-b05">
						<div class="flex__item flex__item--2 flex__item--lg--6 padding-t05 padding-b05">
							<!-- block logo start -->
							<a href="<?= Yii::$app->homeUrl ?>" class="logo" data-scroll-goto="0">
								<img src="/img/logo.png" alt="logo" class="logo__img">
							</a>
							<!-- block logo end -->
						</div>

						<div class="flex__item flex__item--8 flex__item--lg--12 flex__item--lg--end padding-t05 padding-b05s">
							<!-- block menu start -->
							<nav class="menu menu--fluid">
								<?= $mainMenu ?>
							</nav>
							<!-- block menu end -->
						</div>

						<div class="flex__item flex__item--2 flex__item--lg--6 padding-t05 padding-b05">
							<div class="text-right text-nowrap"><b><a href="tel:<?= preg_replace('![^0-9]+!', '', $this->params['siteinfo']->phone) ?>"><i class="fa fa-phone"></i> <?= $this->params['siteinfo']->phone ?></a></b></div>
							<div class="text-right text-small text-nowrap"><a href="mailto:<?= $this->params['siteinfo']->email ?>"><i class="fa fa-envelope"></i> <?= $this->params['siteinfo']->email ?></a></div>
						</div>
					</div>
				</div>
			</section>
		</header>
		<!-- block header end -->

		<!-- block header start -->
		<header class="page__header page__header--mobile js-header-fixed">
			<section class="page__section padding-t1 padding-b1">
				<div class="page__cont">
					<div class="flex flex--vcenter flex--gap-05">
						<div class="flex__item flex__item--4">
							<!-- block logo start -->
							<a href="<?= Yii::$app->homeUrl ?>" class="logo" data-scroll-goto="0">
								<img src="/img/logo.png" alt="logo" class="logo__img">
							</a>
							<!-- block logo end -->
						</div>

						<div class="flex__item flex__item--6">
							<div class="text-right text-nowrap"><b><a href="tel:<?= preg_replace('![^0-9]+!', '', $this->params['siteinfo']->phone) ?>"><i class="fa fa-phone"></i> <?= $this->params['siteinfo']->phone ?></a></b></div>
							<div class="text-right text-small text-nowrap"><a href="mailto:<?= $this->params['siteinfo']->email ?>"><i class="fa fa-envelope"></i> <?= $this->params['siteinfo']->email ?></a></div>
						</div>

						<div class="flex__item flex__item--2">
							<div class="text-right"><a href="#" class="js-slideout-toggle menu-link"><i class="fa fa-2x fa-bars"></i></a></div>
						</div>
					</div>
				</div>
			</section>
		</header>
		<!-- block header end -->

		<main class="page__main">
			<?= $content ?>
		</main>

		<!-- block footer start -->
		<footer class="page__footer">
			<section class="page__section">
				<div class="page__cont ">
					<div class="flex flex--vcenter flex--gap-05 padding-t2 padding-b2">
						<div class="flex__item flex__item--6 flex__item--xs--12 text--xs-center">
							<!-- block logo start -->
							<a href="<?= Yii::$app->homeUrl ?>" class="logo logo--invert" data-scroll-goto="0">
								<img src="/img/logo.png" alt="logo" class="logo__img">
							</a>
							<!-- block logo end -->

							<div class="text-small">© <?= date('Y') ?> <?= $this->params['siteinfo']->copyright ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/terms">Соглашение о конфиденциальности</a>.</div>
						</div>
						<div class="flex__item flex__item--6 flex__item--xs--12">
							<div class="text-right text--xs-center padding-t1 padding-b1">
								<?= $socialMenu ?>
							</div>
						</div>
						<div class="flex__item flex__item--12">
						<div class="text-right text--xs-center text-small"><a href="https://vadimdesign.ru/" target="_blank">Создание сайта: студия дизайна Вадима Гончарова 2017 г.</a></div>
						</div>
					</div>
				</div>
			</section>
		</footer>
		
		<!-- block footer end -->
		<div class="page__bg js-slideout-close"></div>
		<!-- block message start -->
		<div class="message js-message-once">
			<div class="text-center">
				<p>Для вашего удобства мы используем cookies и другие метаданные. Если вы не согласны c этой <a href="#"><b>политикой</b></a>, можете покинуть сайт.</p>
			</div>
			<a href="#" class="button js-ripple js-agree-once">Согласен</a>
		</div>
		<!-- block message end -->
	</div>
	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>