<?php

namespace app\modules\preference\models;

use Yii;
use app\components\helpers\Text;

/********** USE MODELS *********/
use app\modules\file\models\File;
use app\modules\seo\models\Seo;

use app\modules\preference\Module;

/**
 * This is the model class for table "{{%preference}}".
 *
 * @property string $id
 * @property string $title
 * @property string $teaser
 * @property string $body
 * @property string $alias
 * @property string $weight
 * @property integer $status
 */
class Preference extends \yii\db\ActiveRecord
{
	public $imageFile;
	public $imageGallery;
	public $post;

    /**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%preference}}';
    }

    /**
     * SEO
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['content_id' => 'id'])
            ->where(['module' => 'preference']);
    }

    /**
     * THUMBNAIL IMAGE
     */
    public function getThumb($type = 1)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
            ->where(['type' => $type, 'module' => 'preference']);
    }

    /**
     * PHOTO GALLERY
     */
	public function getFiles($type = 2)
    {
        return $this->hasMany(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'preference'])
            ->orderBy('delta');
    }

    /**
     * RULES
     */
    public function rules()
    {
		$this->post = Yii::$app->request->post('Preference');
        return [
            [['title', 'status'], 'required'],
            [['teaser', 'title', 'body', 'alias'], 'string'],
            [['weight', 'status'], 'integer'],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2],
			[['imageGallery'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2, 'maxFiles' => 100],
            [['title'], 'string', 'max' => 255],
			[['weight'], 'default', 'value' => 0],
			[['alias'], 'default', 'value' => Text::transliterate($this->post['title'])],
        ];
    }

    /**
     * LABELS
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'PREFERENCE_BACK_FORM_ID'),
			'title' => Module::t('module', 'PREFERENCE_BACK_FORM_TITLE'),
			'imageFile' => Module::t('module', 'PREFERENCE_BACK_FORM_FILE'),
            'teaser' => Module::t('module', 'PREFERENCE_BACK_FORM_TEASER'),
            'body' => Module::t('module', 'PREFERENCE_BACK_FORM_BODY'),
            'alias' => Module::t('module', 'PREFERENCE_BACK_FORM_ALIAS'),
            'weight' => Module::t('module', 'PREFERENCE_BACK_FORM_WEIGHT'),
            'status' => Module::t('module', 'PREFERENCE_BACK_FORM_STATUS'),
        ];
    }
}