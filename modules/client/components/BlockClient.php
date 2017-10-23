<?php
namespace app\modules\client\components;

use Yii;
use app\modules\client\models\Client;

class BlockClient
{
	public static function front($titleBlock = 'Клиенты', $num = 50)
	{
		$clients = Client::find()->where(['status' => 1, 'is_main' => 0])->orderBy('weight')->limit($num)->all();
		$mainClient = Client::find()->where(['is_main' => 1])->one();
		return Yii::$app->view->renderFile('@app/modules/client/views/client-block-front.php', ['titleBlock' => $titleBlock, 'clients' => $clients, 'mainClient' => $mainClient]);
	}
}