<?php

namespace app\modules\project\models;

use Yii;
use app\components\helpers\Text;

/********** USE MODELS *********/
use app\modules\product\models\Product;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;

use app\modules\project\Module;

/**
 * This is the model class for table "{{%project}}".
 *
 * @property string $id
 * @property string $title
 * @property string $short_title
 * @property string $date
 * @property string $teaser
 * @property string $body
 * @property string $text1 
 * @property string $text2
 * @property string $text3
 * @property string $alias
 * @property string $attach_title
 * @property string $weight
 * @property integer $status
 * @property integer $is_main
 */
class Project extends \yii\db\ActiveRecord
{
	public $imageFile;
	public $bgFile;
	public $videoFileMp4;
	public $videoFileWebm;
	public $videoFileOgv;
	public $imageGallery;

    /**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%project}}';
    }

    /**
     * SEO
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['content_id' => 'id'])
            ->where(['module' => 'project']);
    }
	
	/**
     * VIDEO MP4
     */
    public function getVideoMp4($type = 11)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
            ->where(['type' => $type, 'module' => 'project']);
    }
	
	/**
     * VIDEO Webm
     */
    public function getVideoWebm($type = 12)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
            ->where(['type' => $type, 'module' => 'project']);
    }
	
	/**
     * VIDEO Ogv
     */
    public function getVideoOgv($type = 13)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
            ->where(['type' => $type, 'module' => 'project']);
    }
	
	/**
     * BG IMAGE
     */
    public function getBg($type = 5)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
            ->where(['type' => $type, 'module' => 'project']);
    }

    /**
     * THUMBNAIL IMAGE
     */
    public function getThumb($type = 1)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
            ->where(['type' => $type, 'module' => 'project']);
    }

    /**
     * PHOTO GALLERY
     */
	public function getFiles($type = 2)
    {
        return $this->hasMany(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'project'])
            ->orderBy('delta');
    }
	
	/**
     * PRODUCTS(PRODUCT_PROJECT)
     */
	public function getAttachProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'child_id'])
            ->viaTable('product_project', ['parent_id' => 'id']);
    }

    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['short_title', 'status'], 'required'],
            [['teaser', 'short_title', 'attach_title', 'body', 'text1', 'text2', 'text3', 'alias', 'date'], 'string'],
            [['weight', 'status', 'is_main'], 'integer'],
			
			['videoFileMp4', 'file', 'skipOnEmpty' => true, 'extensions' => 'mp4'],
			['videoFileWebm', 'file', 'skipOnEmpty' => true, 'extensions' => 'webm'],
			['videoFileOgv', 'file', 'skipOnEmpty' => true, 'extensions' => 'ogv'],
		
			[['imageFile', 'bgFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2],
			[['imageGallery'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2, 'maxFiles' => 100],
            [['title', 'short_title'], 'string', 'max' => 255],
			[['title'], 'default', 'value' => function ($model, $attribute) {
				return $model->short_title;
			}],
			[['weight'], 'default', 'value' => 0],
			[['is_main'], 'default', 'value' => 0],
			[['alias'], 'unique', 'message' => 'Значение должно быть уникальным! Материал с таким адресом уже существует на сайте.'],
			[['alias'], 'default', 'value' => function ($model, $attribute) {
				$default_alias = Text::transliterate($model->short_title);
				if(Project::find()->where(['alias' => $default_alias])->one()){
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
            'id' => Module::t('module', 'PROJECT_BACK_FORM_ID'),
            'date' => Module::t('module', 'PROJECT_BACK_FORM_DATE'),
			'title' => Module::t('module', 'PROJECT_BACK_FORM_TITLE'),
			'attach_title' => Module::t('module', 'PROJECT_BACK_FORM_ATTACH_TITLE'),
			'short_title' => Module::t('module', 'PROJECT_BACK_FORM_SHORT_TITLE'),
			'imageFile' => Module::t('module', 'PROJECT_BACK_FORM_FILE'),
			'bgFile' => Module::t('module', 'PROJECT_BACK_FORM_BGFILE'),
			
			'videoFileMp4' => Module::t('module', 'PROJECT_BACK_FORM_VIDEO_MP4_FILE'),
			'videoFileWebm' => Module::t('module', 'PROJECT_BACK_FORM_VIDEO_WEBM_FILE'),
			'videoFileOgv' => Module::t('module', 'PROJECT_BACK_FORM_VIDEO_OGV_FILE'),
			
            'teaser' => Module::t('module', 'PROJECT_BACK_FORM_TEASER'),
            'body' => Module::t('module', 'PROJECT_BACK_FORM_BODY'),
			
			'text1' => Module::t('module', 'PROJECT_BACK_FORM_TEXT1'),
			'text2' => Module::t('module', 'PROJECT_BACK_FORM_TEXT2'),
			'text3' => Module::t('module', 'PROJECT_BACK_FORM_TEXT3'),
			
            'alias' => Module::t('module', 'PROJECT_BACK_FORM_ALIAS'),
            'weight' => Module::t('module', 'PROJECT_BACK_FORM_WEIGHT'),
            'status' => Module::t('module', 'PROJECT_BACK_FORM_STATUS'),
        ];
    }
}