<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use app\modules\banner\models\Banner;
use app\modules\file\components\Img;

use kartik\select2\Select2;

use app\modules\banner\Module;
use yii\grid\GridView;
use app\components\widgets\backend\grid\StatusColumn;
use app\components\widgets\backend\grid\EditColumn;

$this->title = 'Баннеры';
$this->params['breadcrumbs'][] = $this->title;

$pagesLink = \app\components\helpers\PagesLink::_();
?>
<div class="partners-index">
    <h3><?= Html::encode($this->title) ?></h3>
	<hr>
	<?php $form = ActiveForm::begin(['action' => '/admin/' . Module::getInstance()->id . '/create']); ?>
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-3">
			<?= $form->field($newModel, 'type_id')->dropDownList(Banner::getTypeBannerArray()) ?>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3">
			<?= $form->field($newModel, 'pagesArray')->widget(Select2::classname(), [
				'data' => $pagesLink,
				'options' => ['placeholder' => 'Выберите страницы ...', 'multiple' => true],
				'pluginOptions' => [
					'tags' => true,
					'tokenSeparators' => [',', ' '],
					'maximumInputLength' => 100,
					'allowClear' => true,
				],
			]); ?>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3">
			<?= $form->field($newModel, 'imageFile')->fileInput(['accept' => 'image/*']) ?>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-3">
			<div class="form-group pd-top-25">
				<?= Html::submitButton('Быстро создать новый баннер', ['class' => 'btn btn-success']) ?>
			</div>
		</div>
	</div>
	<?php ActiveForm::end(); ?>
	<hr>
	<p>
		<?= Html::a('Создать новый баннер', ['create'], ['class' => 'btn btn-success btn-xs']) ?>
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
				'attribute' => 'imageFile',
				'format' => 'html',
				'value' => function ($model, $key, $index, $column) {
					if($model->thumb){
						return '<img src="'.Img::_(Module::getInstance()->imagesDirectory, $model->id, 'thumbnail', $model->thumb->filename).'">';
					}
				}
			],
			[
				'filter' => Banner::getTypeBannerArray(),
				'attribute' => 'type_id',
				'value' => function ($model, $key, $index, $column) {
					return $model->getTypeBannerName($model->type_id);
				}
			],
			[
				'filter' => Select2::widget([
					'name' => 'BannerSearch[location]',
					'data' => $pagesLink,
					'options' => ['placeholder' => 'Выберите страницу']
				]),
				'attribute' => 'pagesArray',
				'format' => 'html',
				'value' => function ($model) {
					
					$return_string = '';
					
					if($model->pages)
					{
						foreach($model->pages as $value)
						{
							$return_string .= '<span class="label label-default">'.$value->location.'</span> ';
						}
					}
					return $return_string;
				}
			],
			[
				'class' => EditColumn::className(), //Img::_(Module::getInstance()->imagesDirectory, $item->id, 'thumbnail', $item->thumb->filename)
				'attribute' => 'text_block1',
			],
			'text_block3:html',
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