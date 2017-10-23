<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = $this->title;
$this->params['page_class'] = 'page-action';
?>

<section class="cont">
	<?= Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
	<h1 class="h-main"><?= $this->title ?></h1>

	<?php $form = ActiveForm::begin([
		'id' => 'form-signup',
		'method' => 'post',
		'options' => ['class' => 'form'],
		'fieldConfig' => [
			'template' => '{label}{input}{error}',
			'errorOptions' => ['class' => 'error'],
		],
		'errorCssClass' => 'error',
	]); ?>
	
	<?= $form->field($profileModel, 'name')->textInput() ?>
	<?= $form->field($model, 'email')->textInput() ?>
	<?= $form->field($profileModel, 'phone')->textInput() ?>
	<?= $form->field($model, 'password')->passwordInput() ?>
	<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
		'captchaAction' => '/user/default/captcha',
		'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
	]) ?>

	<div class="form-group">
		<?= Html::submitButton('Зарегистрироваться') ?>
	</div>
	<?php ActiveForm::end(); ?>
</section>