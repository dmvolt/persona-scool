<?php

namespace app\modules\preference\components;

use Yii;
use app\modules\preference\models\Preference;

class BlockPreference
{
	public static function _($num = 3)
	{
		$preferences = Preference::find()
				->with('thumb')
				->where(['status' => 1])
				->orderBy('weight')
				->limit($num)
				->all();
				
		return Yii::$app->view->renderFile('@app/modules/preference/views/preference-block-front.php', ['preferences' => $preferences]);
	}
}