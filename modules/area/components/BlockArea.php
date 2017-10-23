<?php
namespace app\modules\area\components;

use Yii;
use app\modules\area\models\Area;

class BlockArea
{
	public static function front($titleBlock = 'Участки', $num = 3)
	{
		$areas = Area::find()->where(['is_main' => 0, 'status' => 1])->orderBy('weight')->limit($num)->all();
		return Yii::$app->view->renderFile('@app/modules/area/views/area-block-front.php', ['titleBlock' => $titleBlock, 'areas' => $areas]);
	}
	
	public static function left($titleBlock = 'Участки', $num = 3)
	{
		$areas = Area::find()->where(['is_main' => 0, 'status' => 1])->orderBy(['date' => SORT_DESC])->limit($num)->all();
		return Yii::$app->view->renderFile('@app/modules/area/views/area-block-left.php', ['titleBlock' => $titleBlock, 'areas' => $areas]);
	}
}