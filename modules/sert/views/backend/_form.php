<?php

use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;
use yii\bootstrap\Collapse;

use app\modules\file\components\Img;
use app\modules\seo\components\Seo;

use app\modules\sert\Module;
?>
<div class="<?= Module::getInstance()->id ?>-form">
    <hr>
	
	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<div class="row">
		<div class="col-xs-6 col-md-2">
			<div class="form-group">
				<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
		</div>
		<div class="col-xs-6 col-md-10">
			<?= $form->field($model, 'status')->checkbox() ?>
		</div>
	</div>
	
	<?php echo Collapse::widget([
		'items' => [
			[
				'label' => 'Фотогалерея сертификатов',
				'content' => Img::_galleryView(Module::getInstance()->imagesDirectory, $model, $form, 'thumbgall', 'files', 'imageGallery[]', 'Фотогалерея сертификатов')
			]
		]
	]); ?>
	
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<div class="row">
				<div class="col-xs-12 col-md-4">
					<?= $form->field($model, 'title')->textInput(['maxlength' => true, 'required' => true]) ?>
				</div>
			</div>
			<?//= $form->field($model, 'alias')->textInput(['maxlength' => true])->label('Алиас (!если поле не заполнено, генерируется автоматически из наименования методом транслитерации)') ?>
		</div>
		<div class="col-xs-12 col-md-4">
		</div>
	</div>
	
    <hr>
	
	<div class="row">
		<div class="col-xs-4 col-md-2">
			<div class="form-group">
				<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
		</div>
		<div class="col-xs-8 col-md-10">
			<?php echo Collapse::widget([
				'items' => [
					[
						'label' => 'SEO',
						'content' => Seo::_fieldsView($model)
					]
				]
			]); ?>
		</div>
	</div>
    <?php ActiveForm::end(); ?>
</div>