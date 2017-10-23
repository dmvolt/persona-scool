<?php
use yii\helpers\Html;
use yii\helpers\Url;

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\bootstrap\Collapse;
use app\modules\file\components\Img;
use app\modules\seo\components\Seo;
use app\modules\service\models\Service;

use app\components\widgets\backend\Items;
use app\modules\service\Module;
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
		<div class="col-xs-6 col-md-2">
			<?= $form->field($model, 'status')->checkbox() ?>
		</div>
		<div class="col-xs-12 col-md-8">
			<?= $form->field($model, 'in_front')->checkbox() ?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<div class="row">
				<div class="col-xs-12 col-md-12">
					<div class="form-group field-service-servicesArray required">
						<label class="control-label" for="service-servicesArray">Родительский материал</label>
						<select class="form-control" name="Service[servicesArray][]">
							<option value="">.. нет ..</option>
							<?= Items::selectItems($selectItems, $model) ?>
						</select>
						<div class="help-block"></div>
					</div>
					
					<?//= $form->field($model, 'servicesArray')->dropDownList(ArrayHelper::map($selectItems, 'id', 'title'), ['size' => 10, 'multiple' => true, 'prompt' => '.. нет ..']) ?>
					<?//= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map($parentItems, 'id', 'title'), ['prompt' => '.. нет ..', 'options' => [$model->parent_id => ['class' => 'selected']]]) ?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-12">
					<?= $form->field($model, 'title')->textInput(['maxlength' => true, 'required' => true]) ?>
				</div>
			</div>
		</div>
		
		<div class="col-xs-12 col-md-4">
			<label>Картинка</label>
			<?php if($model->thumb):?>
				<div class="row">
					<div class="col-xs-12 col-md-12" id="<?= Module::getInstance()->imagesDirectory ?>_<?= $model->id ?>_<?= $model->thumb->id ?>_imageblock">
						<a onclick="deleteImage('<?= Module::getInstance()->imagesDirectory ?>', '<?= $model->id ?>', '<?= $model->thumb->filename ?>', '<?= $model->thumb->id ?>');" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Удалить это изображение">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							<img src="<?= Img::_(Module::getInstance()->imagesDirectory, $model->id, 'thumbnail', $model->thumb->filename) ?>">
						</a>
					</div>
				</div>
			<?php endif; ?>
			<?= $form->field($model, 'imageFile')->fileInput(['accept' => 'image/*']) ?>
		</div>
		<!--<div class="col-xs-12 col-md-4">-->
			<!--<label>Главная картинка 2(правый)</label>
			<?php //if($model->thumb2):?>
				<div class="row">
					<div class="col-xs-12 col-md-12" id="<?//= Module::getInstance()->imagesDirectory ?>_<?//= $model->id ?>_<?//= $model->thumb2->id ?>_imageblock">
						<a onclick="deleteImage('<?//= Module::getInstance()->imagesDirectory ?>', '<?//= $model->id ?>', '<?//= $model->thumb2->filename ?>', '<?//= $model->thumb2->id ?>');" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Удалить это изображение">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							<img src="<?//= Img::_(Module::getInstance()->imagesDirectory, $model->id, 'thumbnail', $model->thumb2->filename) ?>">
						</a>
					</div>
				</div>-->
			<?php //endif; ?>
			<?//= $form->field($model, 'imageFile2')->fileInput(['accept' => 'image/*']) ?>
		<!--</div>-->
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<?= $form->field($model, 'alias')->textInput(['maxlength' => true])->label('Алиас (!если поле не заполнено, генерируется автоматически из наименования методом транслитерации)') ?>
		</div>
		<div class="col-xs-12 col-md-4">
			<br><br>
			<?//= $form->field($model, 'color')->dropDownList(Service::getColorArray(), ['prompt' => '.. нет ..']) ?>
			<?= $form->field($model, 'weight')->textInput(['maxlength' => true, 'class' => 'form-control col-md-4']) ?>
		</div>
	</div>
    
	<hr>
	
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<?= $form->field($model, 'teaser')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
				'editorOptions' => [
					'preset' => 'full', /* basic, standard, full */
					'inline' => false,
					'filebrowserBrowseUrl' => Url::to(['/backend/browse-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'filebrowserUploadUrl' => Url::to(['/backend/upload-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'extraPlugins' => 'imageuploader',
				],
			]); ?>
		</div>
		<!--<div class="col-xs-12 col-md-6">
			<?/* = $form->field($model, 'teaser2')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
				'editorOptions' => [
					'preset' => 'full',
					'inline' => false,
					'filebrowserBrowseUrl' => Url::to(['/backend/browse-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'filebrowserUploadUrl' => Url::to(['/backend/upload-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'extraPlugins' => 'imageuploader',
				],
			]); */ ?>
		</div>-->
	</div>
	
	<!--<div class="row">
		<div class="col-xs-12 col-md-6">
			<?/* = $form->field($model, 'text1')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
				'editorOptions' => [
					'preset' => 'full', 
					'inline' => false,
					'filebrowserBrowseUrl' => Url::to(['/backend/browse-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'filebrowserUploadUrl' => Url::to(['/backend/upload-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'extraPlugins' => 'imageuploader',
				],
			]); */ ?>
		</div>
		<div class="col-xs-12 col-md-6">
			<?/* = $form->field($model, 'text2')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
				'editorOptions' => [
					'preset' => 'full', 
					'inline' => false,
					'filebrowserBrowseUrl' => Url::to(['/backend/browse-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'filebrowserUploadUrl' => Url::to(['/backend/upload-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'extraPlugins' => 'imageuploader',
				],
			]); */ ?>
		</div>
	</div>-->
	
	<!--<div class="row">
		<div class="col-xs-12 col-md-12">
			<?/* = $form->field($model, 'text3')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
				'editorOptions' => [
					'preset' => 'full',
					'inline' => false,
					'filebrowserBrowseUrl' => Url::to(['/backend/browse-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'filebrowserUploadUrl' => Url::to(['/backend/upload-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'extraPlugins' => 'imageuploader',
				],
			]); */ ?>
		</div>
	</div>-->
	
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<?= $form->field($model, 'body')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
				'editorOptions' => [
					'preset' => 'full', /* basic, standard, full */
					'inline' => false,
					'filebrowserBrowseUrl' => Url::to(['/backend/browse-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'filebrowserUploadUrl' => Url::to(['/backend/upload-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'extraPlugins' => 'imageuploader',
				],
			]); ?>
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