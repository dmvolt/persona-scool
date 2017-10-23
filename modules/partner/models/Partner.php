<?php

namespace app\modules\partner\models;

use Yii;

/********** USE MODELS *********/
use app\modules\seo\models\Seo;
use app\modules\file\models\File;

use app\components\helpers\Text;
use app\modules\partner\Module;

/**
 * This is the model class for table "{{%partner}}".
 *
 * @property string $id
 * @property string $title
 * @property string $teaser
 * @property string $body
 * @property string $alias
 * @property string $weight
 * @property integer $status
 * @property integer $is_main
 */
class Partner extends \yii\db\ActiveRecord
{
	public $imageFile;

    /**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%partner}}';
    }

    /**
     * SEO
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['content_id' => 'id'])
            ->where(['module' => 'partner']);
    }

    /**
     * THUMBNAIL IMAGE
     */
	public function getThumb($type = 1)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'partner']);
    }

    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['teaser', 'body', 'alias'], 'string'],
            [['weight', 'status', 'is_main'], 'integer'],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2],
            [['title'], 'string', 'max' => 255],
			[['weight'], 'default', 'value' => 0],
			[['is_main'], 'default', 'value' => 0],
			/* [['alias'], 'unique', 'message' => 'Значение должно быть уникальным! Материал с таким адресом уже существует на сайте.'],
			[['alias'], 'default', 'value' => function ($model, $attribute) {
				$default_alias = Text::transliterate($model->title);
				if(Partner::find()->where(['alias' => $default_alias])->one()){
					return $default_alias.'-'.time();
				}
				else
				{
					return $default_alias;
				}
			}], */
        ];
    }

    /**
     * LABELS
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'PARTNER_BACK_FORM_ID'),
			'title' => Module::t('module', 'PARTNER_BACK_FORM_TITLE'),
			'imageFile' => Module::t('module', 'PARTNER_BACK_FORM_FILE'),
            'teaser' => Module::t('module', 'PARTNER_BACK_FORM_TEASER'),
            'body' => Module::t('module', 'PARTNER_BACK_FORM_BODY'),
            'alias' => Module::t('module', 'PARTNER_BACK_FORM_ALIAS'),
            'weight' => Module::t('module', 'PARTNER_BACK_FORM_WEIGHT'),
            'status' => Module::t('module', 'PARTNER_BACK_FORM_STATUS'),
        ];
    }
}