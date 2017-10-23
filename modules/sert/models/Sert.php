<?php

namespace app\modules\sert\models;

use Yii;
use app\components\helpers\Text;

/********** USE MODELS *********/
use app\modules\file\models\File;
use app\modules\seo\models\Seo;

use app\modules\sert\Module;

/**
 * This is the model class for table "{{%sert}}".
 *
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property string $weight
 * @property integer $status
 * @property integer $is_main
 */
class Sert extends \yii\db\ActiveRecord
{
	public $imageGallery;

    /**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%sert}}';
    }

    /**
     * SEO
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['content_id' => 'id'])
            ->where(['module' => 'sert']);
    }

    /**
     * PHOTO GALLERY
     */
	public function getFiles($type = 2)
    {
        return $this->hasMany(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'sert'])
            ->orderBy('delta');
    }

    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['alias'], 'string'],
            [['weight', 'status', 'is_main'], 'integer'],
			[['imageGallery'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2, 'maxFiles' => 100],
            [['title'], 'string', 'max' => 255],
			[['weight'], 'default', 'value' => 0],
			[['is_main'], 'default', 'value' => 0],
			[['alias'], 'default', 'value' => function ($model, $attribute) {
				$default_alias = Text::transliterate($model->title);
				if(Sert::find()->where(['alias' => $default_alias])->one()){
					return $default_alias.'-'.time();
				}
				else
				{
					return $default_alias;
				}
			}],
        ];
    }

    /**
     * LABELS
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'SERT_BACK_FORM_ID'),
			'title' => Module::t('module', 'SERT_BACK_FORM_TITLE'),
            'alias' => Module::t('module', 'SERT_BACK_FORM_ALIAS'),
            'weight' => Module::t('module', 'SERT_BACK_FORM_WEIGHT'),
            'status' => Module::t('module', 'SERT_BACK_FORM_STATUS'),
        ];
    }
}