<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>

<?php $form = ActiveForm::begin([
	'id' => 'review_form',
	'method' => 'post',
	'options' => ['class' => 'form form--narrow'],
	'fieldConfig' => [
		'template' => '<div class="form__row required">{label}{input}{error}</div>',
		'errorOptions' => ['class' => 'error'],
	],
	'errorCssClass' => 'error',
]); ?>

<div class="form__row text-small">
	* — звездочкой отмечены поля для обязательного заполнения
</div>

<?= $form->field($model, 'name')->label('ФИО', ['class' => 'form__label']) ?>
<?= $form->field($model, 'position')->label('Должность', ['class' => 'form__label']) ?>
<?= $form->field($model, 'text')->textarea(['rows' => 3])->label('Отзыв', ['class' => 'form__label']) ?>

<div class="form__row form__row--buttons">
	<button type="submit" class="button button--main">Отправить <img src="/img/loader.gif" class="loading" style="display:none;"></button>
</div>
<div class="form_success" style="display:none;"></div>
<?php ActiveForm::end(); ?>