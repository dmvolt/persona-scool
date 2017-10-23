<?php
namespace app\modules\review\components;

use Yii;

use app\modules\profile\models\Profile;
use app\modules\review\models\Review;
use app\modules\review\models\forms\FormReview;

class BlockReview
{
	public static function front($titleBlock = 'Отзывы')
	{
		$reviews = Review::find()->where(['status' => 1, 'in_front' => 1])->orderBy('weight')->all();
		return Yii::$app->view->renderFile('@app/modules/review/views/review-block-front.php', ['titleBlock' => $titleBlock, 'reviews' => $reviews]);
	}
	
	public static function _form()
	{
		$model = new FormReview();
		if (!Yii::$app->user->isGuest) 
		{
			if(Yii::$app->user->identity->profile)
			{
				$profileModel = Profile::findOne(Yii::$app->user->identity->profile->id);
				$model->name = $profileModel->name;
			}
		}
		return Yii::$app->view->renderFile('@app/modules/review/views/review-block-form.php', ['model' => $model]);
	}
}