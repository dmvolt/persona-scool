<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\bootstrap\Collapse;
//use vova07\imperavi\Widget;

use mihaildev\ckeditor\CKEditor;

use app\modules\seo\components\Seo;
//use app\components\redactorSetting;
use app\modules\sert\Module;
?>
<div class="<?= Module::getInstance()->id ?>-form">
	<hr>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
	
	<div class="row">
		<div class="col-xs-4 col-md-2">
			<div class="form-group">
				<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
		</div>
		<div class="col-xs-8 col-md-3">
			
		</div>
		<div class="col-xs-8 col-md-7">
			
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-md-12">
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
	
	<?= $form->field($model, 'title')->hiddenInput(['value' => 'Основной материал модуля'])->label('') ?>
    
	<hr>
	
	<div class="row">
		<div class="col-xs-4 col-md-2">
			<div class="form-group">
				<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			</div>
		</div>
		<div class="col-xs-8 col-md-10">
			
		</div>
	</div>
    <?php ActiveForm::end(); ?>
</div>