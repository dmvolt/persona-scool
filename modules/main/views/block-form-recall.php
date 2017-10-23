<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
?>
<div class="popup mfp-hide" id="recall">
	<h2 class="popup_header">Заказать звонок</h2>
	<?php $form = ActiveForm::begin([
		'id' => 'recall_form',
		'method' => 'post',
		'options' => ['class' => 'form'],
		'fieldConfig' => [
			'template' => '{label}{input}{error}',
			'errorOptions' => ['class' => 'error'],
		],
		'errorCssClass' => 'error',
	]); ?>
	
	<?= $form->field($model, 'name')->textInput(['placeholder' => 'Ваше имя'])->label('Имя') ?>
	<?= $form->field($model, 'phone')->textInput(['placeholder' => 'Номер телефона'])->label('Номер телефона') ?>
	<?= $form->field($model, 'time')->textInput(['placeholder' => 'Удобное для звонка время'])->label('Удобное для звонка время') ?>

	<div class="form-group group-submit">
		<button type="submit">Заказать <img src="/img/loader.gif" class="loading" style="display:none;"></button>
	</div>
	<div class="form_success" style="display:none;"></div>
	<?php ActiveForm::end(); ?>
</div>