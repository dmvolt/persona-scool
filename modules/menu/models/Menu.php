<?php

namespace app\modules\menu\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\modules\menu\models\Menu;
use app\modules\menu\Module;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property string $id
 * @property integer $parent_id
 * @property integer $type_id
 * @property string $title
 * @property string $url
 * @property string $icon
 * @property string $label
 * @property string $weight
 * @property integer $status
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }
	
	public function getTypeMenuName($type_id = false)
    {
		if($type_id === false)
		{
			return ArrayHelper::getValue(self::getTypeMenuArray(), $this->type_id);
		}
		else
		{
			return ArrayHelper::getValue(self::getTypeMenuArray(), $type_id);
		}
    }
 
    public static function getTypeMenuArray()
    {
        return [
            0 => 'Главное меню',
            1 => 'Соц. сети',
			/* 2 => 'Меню в нижней части', */
        ];
    }
	
	public static function getSocialIconArray()
    {
        return [
            'facebook' => 'Facebook',
			'twitter' => 'Twitter',
            'vk' => 'Вконтакте',
			'instagram' => 'Инстаграм',
			'ok' => 'Одноклассники',
        ];
    }
	
	public static function getMenuIconArray()
    {
        return [
            /* 'main' => 'MAIN',
			'metal' => 'METAL',
            'plastic' => 'PLASTIC',
			'paper' => 'PAPER',
			'comp' => 'COMP',
			'danger' => 'DANGER',
			'nested' => 'NESTED', */
        ];
    }
	
	public static function getLabelArray()
    {
        return [
            /* 'new' => 'NEW',
			'sale' => 'SALE', */
        ];
    }
	
	/**
     * PARENT
     */
    public function getParent()
    {
        return $this->hasOne(Menu::className(), ['id' => 'parent_id']);
    }

    /**
     * CHILDREN
     */
    public function getChildren()
    {
        return $this->hasMany(Menu::className(), ['parent_id' => 'id']);
    }

    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['title', 'url', 'status'], 'required'],
            [['weight', 'status', 'parent_id', 'type_id'], 'integer'],
			[['weight', 'parent_id'], 'default', 'value' => 0],
            [['title', 'url', 'icon', 'label'], 'string', 'max' => 255]
        ];
    }

    /**
     * LABELS
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'MENU_BACK_FORM_ID'),
            'parent_id' => Module::t('module', 'MENU_BACK_FORM_PID'),
			'type_id' => Module::t('module', 'MENU_BACK_FORM_TYPE_ID'),
            'title' => Module::t('module', 'MENU_BACK_FORM_TITLE'),
            'url' => Module::t('module', 'MENU_BACK_FORM_URL'),
            'icon' => Module::t('module', 'MENU_BACK_FORM_ICON'),
			'label' => Module::t('module', 'MENU_BACK_FORM_LABEL'),
            'weight' => Module::t('module', 'MENU_BACK_FORM_WEIGHT'),
            'status' => Module::t('module', 'MENU_BACK_FORM_STATUS'),
        ];
    }
}