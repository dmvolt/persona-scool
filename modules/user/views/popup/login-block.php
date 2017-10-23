<?php

//use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="morph-button morph-button-modal morph-button-modal-2 morph-button-fixed">

	<?php if(Yii::$app->user->isGuest): ?>
		<button type="button">Вход</button>
	<?php else: ?>
		<?php if(Yii::$app->user->can('adminPanel')):?>
			<a href="/admin/main" target="_blank" class="button">Админка</a>
		<?php else: ?>
			<a href="/account" class="button">Аккаунт</a>
		<?php endif; ?>
	<?php endif; ?>
	
	<div class="morph-content">
		<div class="content-style-form content-style-form-1">
			<span class="icon icon-close"><i class="fa fa-times"></i></span>

			<h2 class="popup_header">Авторизация</h2>
			
			<?php $form = ActiveForm::begin([
				'id' => 'login-form',
				'action' => '/account/login',
				'options' => ['class' => 'form'],
			]); ?>

				<?= $form->field($model, 'username')->textInput(['placeholder' => 'Логин']) ?>
				<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль']) ?>
				<?//= $form->field($model, 'rememberMe')->checkbox([
					/* 'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>", */
				//]) ?>

				<div class="form-group">
					<?= Html::submitButton('Войти') ?>
				</div>
				
				<div class="form-links">
					<?= Html::a('Регистрация', ['/account/signup']) ?>
					<?= Html::a('Восстановление пароля', ['/account/password-reset-request']) ?>
				</div>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>