<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin([
	'id' => 'contact_form',
	'method' => 'post',
	'options' => ['class' => 'form form--shadow'],
	'fieldConfig' => [
		'template' => '{input}{error}{label}',
		'errorOptions' => ['class' => 'error'],
	],
	'errorCssClass' => 'error',
]); ?>

<div class="flex flex--gap-1">
	<div class="flex__item flex__item--6 flex__item--sm--12">
		<?= $form->field($model, 'name')->textInput()->label('Ваше имя',['class'=>'form-label']) ?>
	</div>
	<div class="flex__item flex__item--6 flex__item--sm--12">
		<?= $form->field($model, 'contact')->textInput()->label('Ваш телефон или E-mail',['class'=>'form-label']) ?>
	</div>
	<div class="flex__item flex__item--12">
		<?= $form->field($model, 'text')->textarea(['rows' => 3])->label('Ваш вопрос или сообщение',['class'=>'form-label']) ?>


		<div class="form-group required">
			<input type="checkbox" id="form-9">
			<label for="form-9" class="form-label"> Нажимая кнопку «Отправить сообщение», я даю свое согласие на обработку моих персональных данных, в соответствии
	 с Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных»</label>
		</div>

		<div class="form-group">
			<button class="button js-ripple" type="submit">Отправить сообщение</button>
		</div>
	</div>
</div>
<div class="form_success" style="display:none;"></div>
<?php ActiveForm::end(); ?>
