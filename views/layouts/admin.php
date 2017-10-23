<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\assets\AdminAsset;
use app\components\widgets\Alert;

AdminAsset::register($this);

//Yii::$app->user->identity->username
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="/favicon.ico?v=1" type="image/x-icon">
	<?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
	<?php
	/* Yii::$app->user->identity->username; */
    NavBar::begin([
        'brandLabel' => '<img class="" src="/img/logo.png" alt="" style="width:30px;">',
        'brandUrl' => Url::to(['/main/backend/main/index']),
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
			['label' => 'Аккаунт', 'url' => ['/user/backend/default/index']],
			
			['label' => 'Настройки', 'options' => ['class' => 'mark-menu-item'],
				'items' => [
					['label' => 'Общая информация сайта', 'url' => ['/main/backend/default/index']],
					['label' => 'Настройки почты', 'url' => ['/main/backend/setting/index']],
				],
			],
			
            ['label' => 'Меню', 'url' => ['/menu/backend/default/index']],
			['label' => 'Страницы', 'url' => ['/page/backend/default/index']],
			
			['label' => 'Объекты', 'url' => ['/project/backend/default/index']],
			
			['label' => 'Еще ...', 'options' => ['class' => 'mark-menu-item'],
				'items' => [
					/* ['label' => 'Баннеры', 'url' => ['/banner/backend/default/index']], */
					
					['label' => 'Новости', 'url' => ['/news/backend/default/index']],
					['label' => 'Участки', 'url' => ['/area/backend/default/index']],
					['label' => 'Сертификаты', 'url' => ['/sert/backend/default/index']],
					['label' => 'Клиенты', 'url' => ['/client/backend/default/index']],
					['label' => 'Партнеры', 'url' => ['/partner/backend/default/index']],
					['label' => 'Инфоблоки', 'url' => ['/infoblock/backend/default/index']],
				],
			],
			
			['label' => 'На сайт', 'url' => [Yii::$app->homeUrl], 'linkOptions' => ['target' => '_blank']],
			['label' => 'Выйти', 'url' => ['/user/default/logout'], 'linkOptions' => ['data-method' => 'post']],
        ],
    ]);
    NavBar::end();
    ?>
	<div class="container">
        <?= Breadcrumbs::widget([
			'homeLink' => false,
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
		<?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= date('Y') ?> г.</p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>