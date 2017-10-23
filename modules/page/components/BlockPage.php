<?php
namespace app\modules\page\components;

use Yii;
use app\modules\page\models\Page;

class BlockPage
{
	public static function _($blockId = 'about')
	{
		$infoblock = Page::find()->where(['status' => 1, 'alias' => $blockId])->one();
		
		if($infoblock)
		{
			return Yii::$app->view->renderFile('@app/modules/page/views/page-block.php', ['block' => $infoblock]);
		}
	}
}