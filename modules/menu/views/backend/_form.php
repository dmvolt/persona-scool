<?php
use app\modules\menu\models\Menu;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
?>
<hr>
<div class="menu-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sx-12 col-md-3">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <?= $form->field($model, 'status')->checkbox() ?>
        </div>
        <div class="col-xs-6 col-md-6">
        </div>
    </div>
    <div class="row">
		<div class="col-xs-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'type_id')->dropDownList(Menu::getTypeMenuArray()) ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'parent_id')->dropDownList(ArrayHelper::map($parentItems, 'id', 'title'), ['prompt' => '.. нет ..', 'options' => [$model->parent_id => ['class' => 'selected']]]) ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3">
			<?= $form->field($model, 'icon')->dropDownList(Menu::getMenuIconArray(), ['prompt' => '.. нет ..']) ?>
        </div>
		<div class="col-xs-12 col-sm-3 col-md-3">
			<?= $form->field($model, 'label')->dropDownList(Menu::getLabelArray(), ['prompt' => '.. нет ..']) ?>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-2">
            <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>