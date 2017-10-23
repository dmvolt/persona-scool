<?php
namespace app\modules\partner\components;

use Yii;
use app\modules\partner\models\Partner;

class BlockPartner
{
	public static function front($titleBlock = 'Партнеры', $num = 12)
	{
		$partners = Partner::find()->where(['status' => 1, 'is_main' => 0])->orderBy('weight')->limit($num)->all();
		$mainPartner = Partner::find()->where(['is_main' => 1])->one();
		return Yii::$app->view->renderFile('@app/modules/partner/views/partner-block-front.php', ['titleBlock' => $titleBlock, 'partners' => $partners, 'mainPartner' => $mainPartner]);
	}
}