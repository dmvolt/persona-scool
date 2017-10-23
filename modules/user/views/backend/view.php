<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Аккаунт', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Изменить пароль', ['password-change', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'created_at:datetime',
            'username',
            'email:email',
            'role',
            [
				'label' => 'Статус',
				'value' => ($model->status)? '<p class="text-success">Активный</p>':'<p class="text-danger">Неактивный</p>',
				'format' => 'html',
			],
        ],
    ]) ?>


	<?php if($model->profile):?>
	
		<h3>Профиль: <?= $this->title?></h3>
		<hr>
		
		<?= $this->renderFile('@app/modules/profile/views/backend/view.php', [
			'model' => $model->profile,
		]) ?>
	
	<?php else:?>
		<p>
			<?= Html::a('Добавить профиль для '.$this->title, ['/admin/profile/create', 'user_id' => $model->id], ['class' => 'btn btn-success']) ?>
		</p>
	<?php endif;?>
</div>
