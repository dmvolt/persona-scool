<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\banner\models\Banner;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use app\modules\file\components\Img;
use app\modules\banner\Module;
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
        <div class="col-xs-12 col-md-4">
            <?= $form->field($model, 'type_id')->dropDownList(Banner::getTypeBannerArray()) ?>
            <?= $form->field($model, 'text_block1')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'text_block2')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'button_text')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <?//= $form->field($model, 'location')->textarea(['rows' => 6]); ?>
            <?=
            $form->field($model, 'pagesArray')->widget(Select2::classname(), [
                'data' => \app\components\helpers\PagesLink::_(),
                'options' => ['placeholder' => 'Выберите страницы ...', 'multiple' => true],
                'pluginOptions' => [
                    'tags' => true,
                    'tokenSeparators' => [',', ' '],
                    'maximumInputLength' => 100,
                    'allowClear' => true,
                ],
            ]);
            ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <label>Изображение баннера для десктопа</label>
            <?php if ($model->thumb): ?>
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
            <br>
            <label>Изображение баннера для мобильной версии</label>
            <?php if ($model->thumb2): ?>
                <div class="row">
                    <div class="col-xs-12 col-md-12" id="<?= Module::getInstance()->imagesDirectory ?>_<?= $model->id ?>_<?= $model->thumb2->id ?>_imageblock">
                        <a onclick="deleteImage('<?= Module::getInstance()->imagesDirectory ?>', '<?= $model->id ?>', '<?= $model->thumb2->filename ?>', '<?= $model->thumb2->id ?>');" class="thumbnail" data-toggle="tooltip" data-placement="top" title="Удалить это изображение">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            <img src="<?= Img::_(Module::getInstance()->imagesDirectory, $model->id, 'thumbnail', $model->thumb2->filename) ?>">
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            <?= $form->field($model, 'imageFile2')->fileInput(['accept' => 'image/*']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <?=
            $form->field($model, 'text_block3')->textarea(['rows' => 6])->widget(bajadev\ckeditor\CKEditor::className(), [
				'editorOptions' => [
					'preset' => 'full', /* basic, standard, full */
					'inline' => false,
					'filebrowserBrowseUrl' => Url::to(['/backend/browse-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'filebrowserUploadUrl' => Url::to(['/backend/upload-images', 'id' => $model->id, 'imagesDirectory' => Module::getInstance()->imagesDirectory]),
					'extraPlugins' => 'imageuploader',
				],
			]);
            ?>
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
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>