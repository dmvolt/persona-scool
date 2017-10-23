<?php

use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\ActiveForm;
use yii\bootstrap\Collapse;
use app\modules\file\components\Img;
use app\modules\seo\components\Seo;

use kartik\date\DatePicker;
use app\modules\area\Module;
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
	
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<div class="row">
				<div class="col-xs-12 col-md-4">
					<?= $form->field($model, 'weight')->textInput(['maxlength' => true, 'class' => 'form-control col-md-4']) ?><br><br>
					<?= $form->field($model, 'short_title')->textInput(['maxlength' => true, 'required' => true]) ?>
				</div>
				<div class="col-xs-12 col-md-8">
					<label class="control-label" for="area-date">Дата</label>
					<?= DatePicker::widget([
						'name' => 'Area[date]',
						'value' => $model->date,
						'options' => ['placeholder' => 'Выберите дату ...'],
						'pluginOptions' => [
							'format' => 'yyyy-mm-dd',
							'todayHighlight' => true
						]
					]); ?><br>
					<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
				</div>
			</div>
			<?= $form->field($model, 'alias')->textInput(['maxlength' => true])->label('Алиас (!если поле не заполнено, генерируется автоматически из наименования методом транслитерации)') ?>
		</div>
		<div class="col-xs-12 col-md-4">
			<label>Главная картинка(иконка)</label>
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
			<hr>
			<label>Картинка фона</label>
			<?php if($model->bg):?>
				<div class="row">
					<div class="col-xs-12 col-md-12" id="<?= Module::getInstance()->imagesDirectory ?>_<?= $model->id ?>_<?= $model->bg->id ?>_imageblock">
						<a onclick="deleteImage('<?= Module::getInstance()->imagesDirectory ?>', '<?= $model->id ?>', '<?= $model->bg->filename ?>', '<?= $model->bg->id ?>');" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Удалить это изображение">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							<img src="<?= Img::_(Module::getInstance()->imagesDirectory, $model->id, 'thumbnail', $model->bg->filename) ?>">
						</a>
					</div>
				</div>
			<?php endif; ?>
			<?= $form->field($model, 'bgFile')->fileInput(['accept' => 'image/*']) ?>
		</div>
	</div>
    
	<h3>Видео файлы фона</h3>
	<hr>
	
	<div class="row">
		<div class="col-xs-12 col-md-4">
			<label>Видео файл MP4</label>
			<?php if($model->videoMp4):?>
				<div class="row">
					<div class="col-xs-12 col-md-12" id="<?= Module::getInstance()->videoDirectory ?>_<?= $model->id ?>_<?= $model->videoMp4->id ?>_fileblock">
						<a onclick="deleteVideo('<?= Module::getInstance()->videoDirectory ?>', '<?= $model->id ?>', '<?= $model->videoMp4->filename ?>', '<?= $model->videoMp4->id ?>');" class="thumbnail" title="Удалить этот файл">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							<p><?= $model->videoMp4->filename ?></p>
						</a>
					</div>
				</div>
			<?php endif; ?>
			<?= $form->field($model, 'videoFileMp4')->fileInput(['accept' => 'file/*']) ?>
		</div>
		<div class="col-xs-12 col-md-4">
			<label>Видео файл WEBM</label>
			<?php if($model->videoWebm):?>
				<div class="row">
					<div class="col-xs-12 col-md-12" id="<?= Module::getInstance()->videoDirectory ?>_<?= $model->id ?>_<?= $model->videoWebm->id ?>_fileblock">
						<a onclick="deleteVideo('<?= Module::getInstance()->videoDirectory ?>', '<?= $model->id ?>', '<?= $model->videoWebm->filename ?>', '<?= $model->videoWebm->id ?>');" class="thumbnail" title="Удалить этот файл">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							<p><?= $model->videoWebm->filename ?></p>
						</a>
					</div>
				</div>
			<?php endif; ?>
			<?= $form->field($model, 'videoFileWebm')->fileInput(['accept' => 'file/*']) ?>
		</div>
		<div class="col-xs-12 col-md-4">
			<label>Видео файл OGV</label>
			<?php if($model->videoOgv):?>
				<div class="row">
					<div class="col-xs-12 col-md-12" id="<?= Module::getInstance()->videoDirectory ?>_<?= $model->id ?>_<?= $model->videoOgv->id ?>_fileblock">
						<a onclick="deleteVideo('<?= Module::getInstance()->videoDirectory ?>', '<?= $model->id ?>', '<?= $model->videoOgv->filename ?>', '<?= $model->videoOgv->id ?>');" class="thumbnail" title="Удалить этот файл">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							<p><?= $model->videoOgv->filename ?></p>
						</a>
					</div>
				</div>
			<?php endif; ?>
			<?= $form->field($model, 'videoFileOgv')->fileInput(['accept' => 'file/*']) ?>
		</div>
	</div>
	
	<hr>
	
	<?php echo Collapse::widget([
		'items' => [
			[
				'label' => 'Фотогалерея',
				'content' => '<div class="row">
								<div class="col-xs-12 col-md-12">'
									.$form->field($model, 'attach_title')->textInput(['maxlength' => true]).
								'</div>
							</div>'.Img::_galleryView(Module::getInstance()->imagesDirectory, $model, $form, 'thumbgall', 'files', 'imageGallery[]', 'Фотогалерея')
			]
		]
	]); ?>
	
    <div class="row">
		<div class="col-xs-12 col-md-6">
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
		<div class="col-xs-12 col-md-6">
			<?= $form->field($model, 'text1')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
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
	
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<?= $form->field($model, 'text2')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
				'editorOptions' => [
					'preset' => 'full', /* basic, standard, full */
					'inline' => false,
					'filebrowserBrowseUrl' => Url::to(['/backend/browse-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'filebrowserUploadUrl' => Url::to(['/backend/upload-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'extraPlugins' => 'imageuploader',
				],
			]); ?>
		</div>
		<div class="col-xs-12 col-md-6">
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