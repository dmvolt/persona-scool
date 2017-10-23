<?php
namespace app\modules\project\components;

use Yii;
use app\modules\project\models\Project;

class BlockProject
{
	public static function front($titleBlock = 'Объекты', $num = 3)
	{
		$projects = Project::find()->where(['is_main' => 0, 'status' => 1])->orderBy('weight')->limit($num)->all();
		return Yii::$app->view->renderFile('@app/modules/project/views/project-block-front.php', ['titleBlock' => $titleBlock, 'projects' => $projects]);
	}
}