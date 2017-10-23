<?php

namespace app\modules\team\models;

use Yii;

/********** USE MODELS *********/
use app\modules\seo\models\Seo;
use app\modules\file\models\File;

use app\components\helpers\Text;
use app\modules\team\Module;

/**
 * This is the model class for table "{{%team}}".
 *
 * @property string $id
 * @property string $title
 * @property string $position
 * @property string $teaser
 * @property string $body
 * @property string $alias
 * @property string $weight
 * @property integer $status
 * @property integer $is_top
 * @property integer $is_main
 */
class Team extends \yii\db\ActiveRecord
{
	public $imageFile;

    /**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%team}}';
    }

    /**
     * SEO
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['content_id' => 'id'])
            ->where(['module' => 'team']);
    }

    /**
     * THUMBNAIL IMAGE
     */
	public function getThumb($type = 1)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'team']);
    }

    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['title', 'status', 'position'], 'required'],
            [['teaser', 'body', 'alias'], 'string'],
            [['weight', 'status', 'is_main', 'is_top'], 'integer'],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2],
            [['title', 'position'], 'string', 'max' => 255],
			[['weight'], 'default', 'value' => 0],
			[['is_main'], 'default', 'value' => 0],
			[['is_top'], 'default', 'value' => 0],
			[['alias'], 'unique', 'message' => 'Значение должно быть уникальным! Материал с таким адресом уже существует на сайте.'],
			[['alias'], 'default', 'value' => function ($model, $attribute) {
				$default_alias = Text::transliterate($model->title);
				if(Team::find()->where(['alias' => $default_alias])->one()){
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
            'id' => Module::t('module', 'TEAM_BACK_FORM_ID'),
			'title' => Module::t('module', 'TEAM_BACK_FORM_TITLE'),
			'position' => Module::t('module', 'TEAM_BACK_FORM_POSITION'),
			'imageFile' => Module::t('module', 'TEAM_BACK_FORM_FILE'),
            'teaser' => Module::t('module', 'TEAM_BACK_FORM_TEASER'),
            'body' => Module::t('module', 'TEAM_BACK_FORM_BODY'),
            'alias' => Module::t('module', 'TEAM_BACK_FORM_ALIAS'),
            'weight' => Module::t('module', 'TEAM_BACK_FORM_WEIGHT'),
            'status' => Module::t('module', 'TEAM_BACK_FORM_STATUS'),
			'is_top' => Module::t('module', 'TEAM_BACK_FORM_ISTOP'),
        ];
    }
}