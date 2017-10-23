<?php

namespace app\modules\menu\components;

use Yii;
use app\modules\menu\models\Menu;

class BlockMenu
{
	public static function main($type = 0)
	{
		$menu = [];
		
		$parent_menu = Menu::find()
				->where(['status' => 1, 'parent_id' => 0, 'type_id' => $type])
				->orderBy('weight')
				->all();
				
		if($parent_menu)
		{
			foreach($parent_menu as $value)
			{
				$child_menu = Menu::find()->where(['status' => 1, 'parent_id' => $value->id, 'type_id' => $type])->orderBy('weight')->all();
				$menu[] = [
					'parent' => $value,
					'child' => $child_menu,
				];
			}
		}
		return Yii::$app->view->renderFile('@app/modules/menu/views/block-main-menu.php', ['menu' => $menu]);
	}
	
	public static function main2($type = 0)
	{
		$menu = [];
		
		$parent_menu = Menu::find()
				->where(['status' => 1, 'parent_id' => 0, 'type_id' => $type])
				->orderBy('weight')
				->all();
				
		if($parent_menu)
		{
			foreach($parent_menu as $value)
			{
				$child_menu = Menu::find()->where(['status' => 1, 'parent_id' => $value->id, 'type_id' => $type])->orderBy('weight')->all();
				$menu[] = [
					'parent' => $value,
					'child' => $child_menu,
				];
			}
		}
		return Yii::$app->view->renderFile('@app/modules/menu/views/block-main-menu2.php', ['menu' => $menu]);
	}
	
	public static function mainFooter($type = 2)
	{
		$menu = Menu::find()
				->where(['status' => 1, 'parent_id' => 0, 'type_id' => $type])
				->orderBy('weight')
				->all();
				
		return Yii::$app->view->renderFile('@app/modules/menu/views/block-main-footer-menu.php', ['menu' => $menu]);
	}
	
	public static function social($type = 1)
	{
		$menu = Menu::find()
				->where(['status' => 1, 'parent_id' => 0, 'type_id' => $type])
				->orderBy('weight')
				->all();
				
		return Yii::$app->view->renderFile('@app/modules/menu/views/block-social-menu.php', ['menu' => $menu]);
	}
	
	public static function socialFooter($type = 1)
	{
		$menu = Menu::find()
				->where(['status' => 1, 'parent_id' => 0, 'type_id' => $type])
				->orderBy('weight')
				->all();
				
		return Yii::$app->view->renderFile('@app/modules/menu/views/block-social-footer-menu.php', ['menu' => $menu]);
	}
}