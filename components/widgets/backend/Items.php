<?php

namespace app\components\widgets\backend;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use app\modules\file\components\Img;
use app\components\helpers\Text;

class Items
{
	public static function catalogListEndItems($dataProvider, $url = '', $parentId = 0)
    {
		$return = '';
		
		if ($dataProvider) 
		{
			foreach ($dataProvider as $element) 
			{
				if ($parentId != 0) 
				{
					if($element->parent && !$element->children)
					{
						foreach($element->parent as $item)
						{
							if ($item->id == $parentId) 
							{
								$return .= '<div class="program__item">';
								$return .= Text::_edit($element->id, 'service'); /** Ссылка на редактирование материала **/
								
								$return .= '<a href="/'.$url.'/'.$element->alias.'" class="convex"><div class="convex__gor"><div class="convex__vert">';
								if($element->thumb){
									$return .= '<img src="'.Img::_('service', $element->id, 'big-square', $element->thumb->filename).'">';
								}
								if(!empty($element->text1)){
									$return .= '<div class="convex__price">'.$element->text1.'</div>';
								}
								$return .= '</div></div></a>';
								
								$return .= '<div class="program__content">';
								$return .= '<h3 class="program__header"><a href="/'.$url.'/'.$element->alias.'">'.$element->short_title.'</a></h3>';
								$return .= '<div class="program__text">';
								$return .= $element->teaser;
								$return .= '</div>';
								$return .= '</div>';
								$return .= '<a href="#consult" class="button js-popup-inline">Записаться</a>';
								$return .= '</div>';
							}
						}
					}
				}
			}
		}
        return $return;
    }
	
	public static function catalogListChildItems($dataProvider, $url = '', $parentId = 0)
    {
		$return = '';
		
		if ($dataProvider) 
		{
			$return .= '<ul>';
			
			foreach ($dataProvider as $element) 
			{
				if ($parentId != 0) 
				{
					if($element->parent)
					{
						foreach($element->parent as $item)
						{
							if ($item->id == $parentId) 
							{
								$return .= '<li><a href="/'.$url.'/'.$element->alias.'">'.$element->short_title.'</a></li>';
							}
						}
					}
				}
			}
			$return .= '</ul>';
		}
        return $return;
    }
	
	
	
	
	public static function catalogFrontListItems($dataProvider, $url = '', $parentId = 0, $level = 0, $foolproof = 20)
    {
		$return = '';
		
		if ($dataProvider) 
		{
			foreach ($dataProvider as $element) 
			{
				if ($parentId == 0) 
				{
					if(!$element->parent)
					{
						$return .= '<div class="cont-flex__item">';
						$return .= '<div class="card">';
						$element->level = $level;
						$return .= Text::_edit($element->id, 'service'); /** Ссылка на редактирование материала **/
						
						$return .= '<div class="card__preview">';
						if($element->thumb){
							$return .= '<img src="'.Img::_('service', $element->id, 'middle-square', $element->thumb->filename).'" class="card__img">';
						}
						$return .= '</div>';
						
						$return .= '<h3 class="card__header"><a href="/'.$url.'/'.$element->alias.'">'.$element->short_title.'</a></h3>';
						$return .= '<div class="card__hover">';
						
						$parentUrl = $url.'/'.$element->alias;
						
						$return .= self::catalogFrontListItems($dataProvider, $parentUrl, $element->id, $level+1, $foolproof-1);
						
						$return .= '</div>';
						$return .= '</div>';
						$return .= '</div>';
					}
				} 
				else 
				{
					if($element->parent)
					{
						foreach($element->parent as $item)
						{
							if ($item->id == $parentId) 
							{
								$element->level = $level;

								$return .= '<a href="'.$url.'/'.$element->alias.'">'.$element->short_title.'</a><br>';
								//$parentUrl = $url.'/'.$element->alias;
								//$return .= self::catalogListItems($dataProvider, $parentUrl, $element->id, $level+1, $foolproof-1);
							}
						}
					}
				}
			}
		}
        return $return;
    }
	
	
	public static function catalogServicesListItems($dataProvider, $url = '', $parentId = 0, $level = 0, $foolproof = 20)
    {
		$return = '';
		
		if ($dataProvider) 
		{
			foreach ($dataProvider as $element) 
			{
				if ($parentId == 0) 
				{
					if(!$element->parent)
					{
						$return .= '<div class="cont-flex__item">';
						$return .= '<div class="card">';
						$element->level = $level;
						$return .= Text::_edit($element->id, 'service'); /** Ссылка на редактирование материала **/
						
						$return .= '<a href="/'.$url.'/'.$element->alias.'" class="card__preview">';
						if($element->thumb){
							$return .= '<img src="'.Img::_('service', $element->id, 'middle-square', $element->thumb->filename).'" class="card__img">';
						}
						$return .= '</a>';
						
						$return .= '<h3 class="card__header"><a href="/'.$url.'/'.$element->alias.'">'.$element->short_title.'</a></h3>';
						$return .= '<div class="card__hover">';
						
						$parentUrl = $url.'/'.$element->alias;
						
						$return .= self::catalogServicesListItems($dataProvider, $parentUrl, $element->id, $level+1, $foolproof-1);
						
						$return .= '</div>';
						$return .= '</div>';
						$return .= '</div>';
					}
				} 
				else 
				{
					if($element->parent)
					{
						foreach($element->parent as $item)
						{
							if ($item->id == $parentId) 
							{
								$element->level = $level;

								$return .= '<a href="'.$url.'/'.$element->alias.'">'.$element->short_title.'</a><br>';
								//$parentUrl = $url.'/'.$element->alias;
								//$return .= self::catalogListItems($dataProvider, $parentUrl, $element->id, $level+1, $foolproof-1);
							}
						}
					}
				}
			}
		}
        return $return;
    }
	
	
	
	
	
	
	public static function catalogListItems($dataProvider, $url = '', $parentId = 0, $level = 0, $foolproof = 20)
    {
		$return = '';
		
		if ($dataProvider) 
		{
			foreach ($dataProvider as $element) 
			{
				if ($parentId == 0) 
				{
					if(!$element->parent)
					{
						$return .= '<div class="cat__item">';
						
						$element->level = $level;
						$return .= Text::_edit($element->id, 'service'); /** Ссылка на редактирование материала **/
						
						$return .= '<a href="/'.$url.'/'.$element->alias.'" class="cat__header">';
						if($element->thumb){
							$return .= '<img src="'.Img::_('service', $element->id, 'original', $element->thumb->filename).'">';
						}
						$return .= '<h2>'.$element->short_title.'</h2>';
						$return .= '</a>';
						
						$parentUrl = $url.'/'.$element->alias;
						$return .= self::catalogListItems($dataProvider, $parentUrl, $element->id, $level+1, $foolproof-1);
						
						$return .= '</div>';
					}
				} 
				else 
				{
					if($element->parent)
					{
						$return .= '<ul class="cat__ul">';
						
						foreach($element->parent as $item)
						{
							if ($item->id == $parentId) 
							{
								$element->level = $level;
								$return .= '<li class="cat__li">';
								$return .= '<a href="'.$url.'/'.$element->alias.'">'.$element->short_title.'</a>';
								$parentUrl = $url.'/'.$element->alias;
								$return .= self::catalogListItems($dataProvider, $parentUrl, $element->id, $level+1, $foolproof-1);
								$return .= '</li>';
							}
						}
						$return .= '</ul>';
					}
				}
			}
		}
        return $return;
    }
	
	public static function listItems($dataProvider, $url = '/', $parentId = 0, $level = 0, $foolproof = 20)
    {
		$return = '';
		
		if ($dataProvider) 
		{
			if ($parentId == 0) 
			{
				$return .= '<ul class="nav__sub-ul">';
			} 
			else 
			{
				$return .= '<ul class="nav__sub-ul-gor">';
			}
			
			foreach ($dataProvider as $element) 
			{
				if ($parentId == 0) 
				{
					if(!$element->parent)
					{
						$element->level = $level;
						$return .= '<li class="nav__sub-li">';
						$return .= '<a href="'.$url.'/'.$element->alias.'">'.$element->title.'</a>';
						$parentUrl = $url.'/'.$element->alias;
						$return .= self::listItems($dataProvider, $parentUrl, $element->id, $level+1, $foolproof-1);
						$return .= '</li>';
					}
				} 
				else 
				{
					if($element->parent)
					{
						foreach($element->parent as $item)
						{
							if ($item->id == $parentId) 
							{
								$element->level = $level;
								$return .= '<li class="nav__sub-li">';
								$return .= '<a href="'.$url.'/'.$element->alias.'">'.$element->title.'</a>';
								$parentUrl = $url.'/'.$element->alias;
								$return .= self::listItems($dataProvider, $parentUrl, $element->id, $level+1, $foolproof-1);
								$return .= '</li>';
							}
						}
					}
				}
			}
			$return .= '</ul>';
		}
        return $return;
    }
	
    public static function selectParentItems($dataProvider)
    {
		$return = [];
		
		if ($dataProvider) 
		{
			foreach ($dataProvider as $element) 
			{
				if(!$element->parent)
				{
					$return[] = $element;
				}
			}
		}
        return $return;
    }
	
	public static function selectItems($dataProvider, $model = null)
    {
		$return = '';
		$parents = [];
		
		$items = self::buildRecursive($dataProvider);
		
		if($items && !empty($items))
		{
			if($model && $model->parent)
			{
				foreach($model->parent as $parent)
				{
					$parents[$parent->id] = $parent->id;
				}
			}
			
			foreach($items as $item)
			{
				$selected = '';
				
				if(isset($parents[$item->id]))
				{
					$selected = 'selected';
				}
				
				if($model && $model->id == $item->id)
				{
					$selected = 'disabled';
				}
				
				$return .= '<option value="'.$item->id.'" '.$selected;
				$return .= (!$item->level)?' style="font-weight:bold;"':'';
				$return .= '>';
				$return .= str_repeat('--', $item->level).' ';
				$return .= $item->title.'</option>';
			}
		}
		return $return;
    }
	
	protected static function buildRecursive(array $data, $parentId = 0, $level = 0, $foolproof = 20) {
        $return = [];
        foreach ($data as $element) 
		{
			if ($parentId == 0) 
			{
				if(!$element->parent)
				{
					$element->level = $level;
					$return[] = $element;
					$children = self::buildRecursive($data, $element->id, $level+1, $foolproof-1);
					if ($children) 
					{
						$return = array_merge($return, $children);
					}
				}
				
			} 
			else 
			{
				if($element->parent)
				{
					foreach($element->parent as $item)
					{
						if ($item->id == $parentId) 
						{
							$element->level = $level;
							$return[] = $element;
							$children = self::buildRecursive($data, $element->id, $level+1, $foolproof-1);
							if ($children)
							{
								$return = array_merge($return, $children);
							}
						}
					}
				}
			}
        }
        return $return;
    }
} 
