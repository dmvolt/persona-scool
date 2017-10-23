<?php

namespace app\modules\banner\components;
use Yii;
use app\modules\banner\models\Banner;

class BlockBanner
{
	public static function _($type = 0, $location = '', $template = '', $num = 100)
	{
		$query = Banner::find()->joinWith('pages');
		$query->where(['banner.type_id' => $type, 'banner.status' => 1]);
			
		if($location == '')
		{
			$query->andWhere(['banner_page.location' => 'front']);
		}
		else
		{
			$query->andWhere(['banner_page.location' => $location]);
		}
		
		$query->orderBy('banner.weight');
		$query->limit($num);
		$content = $query->all();
		
		return Yii::$app->view->renderFile('@app/modules/banner/views/banner-block-'.$type.$template.'.php', ['content' => $content]);
	}
}