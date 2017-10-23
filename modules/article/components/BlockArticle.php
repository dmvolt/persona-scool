<?php
namespace app\modules\article\components;

use Yii;
use app\modules\article\models\Article;

class BlockArticle
{
	public static function front($titleBlock = 'Статьи', $num = 3)
	{
		$articles = Article::find()->where(['is_main' => 0, 'status' => 1])->orderBy('weight')->limit($num)->all();
		return Yii::$app->view->renderFile('@app/modules/article/views/article-block-front.php', ['titleBlock' => $titleBlock, 'articles' => $articles]);
	}
	
	public static function left($titleBlock = 'Статьи', $num = 3)
	{
		$articles = Article::find()->where(['is_main' => 0, 'status' => 1])->orderBy(['date' => SORT_DESC])->limit($num)->all();
		return Yii::$app->view->renderFile('@app/modules/article/views/article-block-left.php', ['titleBlock' => $titleBlock, 'articles' => $articles]);
	}
}