<?php 
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use app\modules\file\components\Img;
use app\modules\infoblock\components\BlockText;

use app\components\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = $this->title;
$this->params['page-action'] = 'page-article';
?>
<section class="cont">
	<?= Breadcrumbs::widget([
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
	]) ?>
	<h1 class="h-main">Личный кабинет</h1>
	
	<?php if($profileModel):?>
	
		<div class="cont cont-cards">
			<div class="cont-cards__item">
				<?php $form = ActiveForm::begin([
					'id' => 'form-edit-profile',
					'method' => 'post',
					'options' => ['class' => 'form', 'enctype' => 'multipart/form-data'],
					'fieldConfig' => [
						'template' => '{input}{error}',
						'errorOptions' => ['class' => 'error'],
					],
					'errorCssClass' => 'error',
				]); ?>
				
					<?= $form->field($profileModel, 'name')->textInput() ?>
					<?= $form->field($userModel, 'email')->textInput() ?>
					<?= $form->field($profileModel, 'phone')->textInput() ?>
					<div class="form-group">
						<?= Html::submitButton('Изменить информацию') ?>
					</div>
				<?php ActiveForm::end(); ?>
			</div>
			
			<div class="cont-cards__item">
				<form class="form">
					<div class="form-group required">
						<label for="form-4">Пароль</label>
						<input id="form-4" type="password">
					</div>
					<div class="form-group required">
						<label for="form-5">Подтверждение пароля</label>
						<input id="form-5" type="password">
					</div>
					<div class="form-group form-group_check">
							<input type="checkbox" id="check-1">
							<label for="check-1">Сгенерировать пароль</label>
					</div>
					<div class="form-group">
						<button type="submit">Изменить пароль</button>
					</div>
				</form>
			</div>
		</div>
		<h2 class="h-main">История заказов</h1>
		
	<?php else:?>
	
		<h2>У вас нет профиля, если это ошибка, обратитесь к администратору.</h2>
	
	<?php endif;?>
</section>
<?php if($profileModel):?>
	<section class="program program_light">
		<div class="cont">
			<table class="cabinet-table">
				<tr>
					<td><a href="#">Мастер-класс «Приручи своих драконов»</a></td>
					<td>04.06.2016</td>
					<td><b>1000 руб.</b></td>
				</tr>
				<tr>
					<td><a href="#">Мастер-класс «Приручи своих драконов»</a></td>
					<td>04.06.2016</td>
					<td><b>1000 руб.</b></td>
				</tr>
				<tr>
					<td><a href="#">Мастер-класс «Приручи своих драконов»</a></td>
					<td>04.06.2016</td>
					<td><b>1000 руб.</b></td>
				</tr>
				<tr>
					<td><a href="#">Мастер-класс «Приручи своих драконов»</a></td>
					<td>04.06.2016</td>
					<td><b>1000 руб.</b></td>
				</tr>
				<tr>
					<td><a href="#">Мастер-класс «Приручи своих драконов»</a></td>
					<td>04.06.2016</td>
					<td><b>1000 руб.</b></td>
				</tr>
			</table>
		</div>
	</section>
<?php endif;?>