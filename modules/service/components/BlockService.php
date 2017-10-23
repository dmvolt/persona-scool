<?php

namespace app\modules\service\components;

use Yii;
use app\modules\service\models\Service;

class BlockService
{
	public static function _frontIsFirst()
	{
		$services = Service::find()
				->where(['status' => 1, 'in_front' => 1])
				->orderBy('weight')
				->all();
				
		return Yii::$app->view->renderFile('@app/modules/service/views/service-block-front-first.php', ['services' => $services]);
	}
	
	public static function _serviceIsFirst($currentId = 0)
	{
		$services = Service::find()
				->where(['status' => 1, 'in_front' => 1])
				->andWhere(['<>', 'id', $currentId])
				->orderBy('weight')
				->all();
				
		return Yii::$app->view->renderFile('@app/modules/service/views/service-block-first.php', ['services' => $services]);
	}
	
	public static function _frontIsSecond($currentId = 0)
	{
		$services = Service::find()
				->where(['status' => 1, 'in_front' => 0])
				->andWhere(['<>', 'id', $currentId])
				->orderBy('weight')
				->all();
				
		return Yii::$app->view->renderFile('@app/modules/service/views/service-block-front-second.php', ['services' => $services]);
	}
}