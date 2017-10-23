<?php
namespace app\modules\sert\components;

use Yii;
use app\modules\sert\models\Sert;

class BlockSert
{
	public static function front($titleBlock = 'Сертификаты', $num = 3)
	{
		$serts = Sert::find()->where(['status' => 1])->orderBy('weight')->limit($num)->all();
		//return $this->render('/sert-block', ['titleBlock' => $titleBlock, 'serts' => $serts]);
		return Yii::$app->view->renderFile('@app/modules/sert/views/sert-block-front.php', ['titleBlock' => $titleBlock, 'serts' => $serts]);
	}
}