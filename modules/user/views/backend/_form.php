<?php

use app\modules\user\models\User;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
?>
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sx-12 col-md-3">
            <div class="form-group pd-top-25">
                <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-3">
            <?= $form->field($model, 'status')->dropDownList(User::getStatusesArray()) ?>
        </div>
        <div class="col-xs-6 col-md-6">

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'role')->dropDownList(ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description')) ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
