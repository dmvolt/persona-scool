<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
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
		'id' => 'reset-password-form',
		'method' => 'post',
		'options' => ['class' => 'form'],
		'fieldConfig' => [
			'template' => '{label}{input}{error}',
			'errorOptions' => ['class' => 'error'],
		],
		'errorCssClass' => 'error',
	]); ?>

		<?= $form->field($model, 'password')->passwordInput() ?>

		<div class="form-group">
			<?= Html::submitButton('Сохранить') ?>
		</div>
	<?php ActiveForm::end(); ?>
</section>