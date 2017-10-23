<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\widgets\ActiveForm;

use app\components\widgets\backend\grid\StatusColumn;
use app\components\widgets\backend\grid\EditColumn;
use app\modules\page\Module;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <h3><?= Html::encode($this->title) ?></h3>

	<hr>
	<?php $form = ActiveForm::begin(['action' => '/admin/' . Module::getInstance()->id . '/create-fast']); ?>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-3">
			<?= $form->field($newModel, 'title')->textInput(['maxlength' => true]) ?>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3">
			<div class="form-group pd-top-25">
				<?= Html::submitButton('Быстро создать новую запись', ['class' => 'btn btn-success']) ?>
			</div>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
	<hr>

    <p>
        <?= Html::a('Создать новую запись', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
		<?= Html::button('Сохранить изменения', ['class' => 'btn btn-warning btn-xs right', 'onclick' => 'multiUpdate("update_form")']) ?>
    </p>

	<?= Html::beginForm('/admin/' . Module::getInstance()->id . '/multi-action', 'post', ['id' => 'update_form']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			['class' => 'yii\grid\CheckboxColumn'],
			[
				'class' => EditColumn::className(),
				'attribute' => 'title',
			],
			[
				'class' => EditColumn::className(),
				'attribute' => 'alias',
				'style' => 'middle center',
			],
			[
				'class' => EditColumn::className(),
				'attribute' => 'weight',
				'fieldType' => 'number',
				'style' => 'small right',
			],
			[
				'class' => StatusColumn::className(),
				'attribute' => 'status',
			],
            [	
				'class' => 'yii\grid\ActionColumn', 
				'template' => '<p class="text-right">{update}&nbsp;&nbsp;{delete}</p>'
			],
        ],
    ]); ?>
	<?= Html::endForm()?>
</div>
