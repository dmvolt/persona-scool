<?php
namespace app\modules\news\components;

use Yii;
use app\modules\news\models\News;

class BlockNews
{
	public static function front($titleBlock = 'Новости', $num = 3)
	{
		$news = News::find()->where(['is_main' => 0, 'status' => 1])->orderBy('weight')->limit($num)->all();
		return Yii::$app->view->renderFile('@app/modules/news/views/news-block-front.php', ['titleBlock' => $titleBlock, 'news' => $news]);
	}
}