<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin([
	'id' => 'search_form'.$class,
	'action' => '/search',
	'method' => 'get',
	'options' => ['class' => 'header__search '.$class],
	'fieldConfig' => [
		'template' => '{input}{error}',
		'errorOptions' => ['class' => 'error'],
	],
	'errorCssClass' => 'error',
]); ?>

<?= $form->field($model, 'q')->textInput(['value' => $q, 'class' => 'header__search-input', 'placeholder' => 'Введите услугу, которую хотите найти']); ?>

<button type="submit" class="header__search-button">
	<object data="/img/poisk.svg" type="image/svg+xml" class="js-svg"></object>
</button>
<?php ActiveForm::end(); ?>