<?php
namespace app\modules\team\components;

use Yii;
use app\modules\team\models\Team;

class BlockTeam
{
	public static function front($titleBlock = 'Наша Команда', $num = 3)
	{
		$teams = Team::find()->where(['status' => 1, 'is_main' => 0])->orderBy('weight')->limit($num)->all();
		return Yii::$app->view->renderFile('@app/modules/team/views/team-block-front.php', ['titleBlock' => $titleBlock, 'teams' => $teams]);
	}
}