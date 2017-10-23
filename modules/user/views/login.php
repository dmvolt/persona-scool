<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
 
<?php $form = ActiveForm::begin([
	'id' => 'login-form',
]); ?>

	<?= $form->field($model, 'username') ?>
	<?= $form->field($model, 'password')->passwordInput() ?>
	<?= $form->field($model, 'rememberMe')->checkbox([
		/* 'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>", */
	]) ?>

	<div class="form-group">
		<div class="">
			<?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
		</div>
	</div>
	
	<p>Забыли пароль? <?= Html::a('Вспомнить', ['password-reset-request']) ?></p>

<?php ActiveForm::end(); ?>