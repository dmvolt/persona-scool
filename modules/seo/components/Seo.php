<?php
namespace app\modules\seo\components;

use Yii;

class Seo
{
	public static function _fieldsView($model = NULL, $blockTitle = '')
	{
		$data = [
			'title_h1' => '',
			'meta_title' => '',
			'meta_key' => '',
			'meta_desc' => '',
		];

		if($model->seo)
		{
			$data = [
				'title_h1' => $model->seo->title_h1,
				'meta_title' => $model->seo->meta_title,
				'meta_key' => $model->seo->meta_key,
				'meta_desc' => $model->seo->meta_desc,
			];
		}
		return Yii::$app->view->renderFile('@app/modules/seo/views/backend/fields-block.php',
											[
												'data' => $data,
												'blockTitle' => $blockTitle,
											]
										);
	}
}