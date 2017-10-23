<?php

namespace app\modules\main\components;

use Yii;
use app\modules\main\models\forms\FormContact;
use app\modules\main\models\forms\FormRecall;

class BlockForm
{
	public static function _contact()
	{
		$model = new FormContact();
		return Yii::$app->view->renderFile('@app/modules/main/views/block-form-contact.php', ['model' => $model]);
	}
	
	public static function _recall()
	{
		$model = new FormRecall();
		return Yii::$app->view->renderFile('@app/modules/main/views/block-form-recall.php', ['model' => $model]);
	}
}