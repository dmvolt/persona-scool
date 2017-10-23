<?php
namespace app\components\helpers;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

use app\modules\page\models\Page;

class PagesLink
{
	public static function _($currentUrl = false)
	{
		$items = [];
		
		$pages = Page::find()->where(['status' => 1])->all();
		
		// Main
		$items['front'] = 'Главная';
		
		// Pages
		if($pages)
		{
			foreach($pages as $item)
			{
				$items[$item->alias] = $item->title;
			}
		}
		
		if($currentUrl)
		{
			return (isset($items[$currentUrl]))? $items[$currentUrl]:'';
		}
		else
		{
			return $items;
		}
	}
}