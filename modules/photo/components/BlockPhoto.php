<?php
namespace app\modules\photo\components;

use Yii;
use app\modules\photo\models\Photo;

class BlockPhoto
{
	public static function _($blockId = 'about')
	{
		$infoblock = Photo::find()->where(['status' => 1, 'alias' => $blockId])->one();
		
		if($infoblock)
		{
			return Yii::$app->view->renderFile('@app/modules/photo/views/photo-block.php', ['block' => $infoblock]);
		}
	}
}