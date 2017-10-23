<?php

namespace app\modules\banner\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\components\helpers\Text;
use app\modules\banner\Module;

/* * ******** USE MODELS ******** */
use app\modules\file\models\File;
use app\modules\banner\models\BannerPage;

/**
 * This is the model class for table "{{%banner}}".
 *
 * @property integer $id
 * @property integer $cat_id
 * @property integer $type_id
 * @property string $location
 * @property string $text_block1
 * @property string $text_block2
 * @property string $text_block3
 * @property string $button_text
 * @property integer $weight
 * @property integer $status
 */
class Banner extends \yii\db\ActiveRecord {

    public $imageFile;
    public $imageFile2;
    private $_pagesArray;

    /**
     * TABLE NAME
     */
    public static function tableName() {
        return '{{%banner}}';
    }

    /**
     * TYPES
     */
    public function getTypeBannerName($type_id = false) {
        if ($type_id === false) {
            return ArrayHelper::getValue(self::getTypeBannerArray(), $this->type_id);
        } else {
            return ArrayHelper::getValue(self::getTypeBannerArray(), $type_id);
        }
    }

    public static function getTypeBannerArray() {
        return [
            0 => 'Рекламный баннер вверху (главный)',
            1 => 'Рекламный баннер справа от главного',
        ];
    }

    /**
     * THUMBNAIL IMAGE
     */
    public function getThumb($type = 1) {
        return $this->hasMany(File::className(), ['content_id' => 'id'])
                        ->where(['type' => $type, 'module' => 'banner'])
                        ->one();
    }
    
    /**
     * ICON IMAGE
     */
    public function getThumb2($type = 4) {
        return $this->hasMany(File::className(), ['content_id' => 'id'])
                        ->where(['type' => $type, 'module' => 'banner'])
                        ->one();
    }

    /**
     * PAGES
     */
    public function getPages() {
        return $this->hasMany(BannerPage::className(), ['banner_id' => 'id']);
    }

    /**
     * UPDATE PAGES
     */
    private function updatePages() {
        $currentPageUrls = $this->getPages()->select('location')->column();
        $newPageUrls = $this->getPagesArray();
        foreach (array_filter(array_diff($newPageUrls, $currentPageUrls)) as $pageUrl) {

            $newBannerPageModel = new BannerPage();
            $newBannerPageModel->location = $pageUrl;
            $newBannerPageModel->banner_id = $this->id;
            $newBannerPageModel->save();
        }
        foreach (array_filter(array_diff($currentPageUrls, $newPageUrls)) as $pageUrl) {
            BannerPage::deleteAll(['location' => $pageUrl, 'banner_id' => $this->id]);
        }
    }

    public function getPagesArray() {
        if ($this->_pagesArray === null) {
            $this->_pagesArray = $this->getPages()->select('location')->column();
        }
        return $this->_pagesArray;
    }

    public function setPagesArray($value) {
        $this->_pagesArray = (array) $value;
    }

    /**
     * RULES
     */
    public function rules() {
        return [
            [['cat_id', 'type_id', 'weight', 'status'], 'integer'],
            [['text_block1', 'text_block2', 'text_block3', 'button_text'], 'string'],
            [['imageFile', 'imageFile2'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024 * 1024) * 2],
            [['pagesArray'], 'safe'],
            [['button_text'], 'default', 'value' => 'Посмотреть примеры'],
            [['weight'], 'default', 'value' => 0],
            [['type_id'], 'default', 'value' => 0],
        ];
    }

    /**
     * LABELS
     */
    public function attributeLabels() {
        return [
            'id' => Module::t('module', 'BANNER_BACK_FORM_ID'),
            'cat_id' => Module::t('module', 'BANNER_BACK_FORM_CAT_ID'),
            'type_id' => Module::t('module', 'BANNER_BACK_FORM_TYPE'),
            'text_block1' => Module::t('module', 'BANNER_BACK_FORM_TEXT1'),
            'text_block2' => Module::t('module', 'BANNER_BACK_FORM_TEXT2'),
            'text_block3' => Module::t('module', 'BANNER_BACK_FORM_TEXT3'),
            'button_text' => Module::t('module', 'BANNER_BACK_FORM_BUTTON_TEXT'),
            'pagesArray' => Module::t('module', 'BANNER_BACK_FORM_LOCATION'),
            'imageFile' => Module::t('module', 'BANNER_BACK_FORM_FILE'),
            'imageFile2' => Module::t('module', 'BANNER_BACK_FORM_FILE2'),
            'weight' => Module::t('module', 'BANNER_BACK_FORM_WEIGHT'),
            'status' => Module::t('module', 'BANNER_BACK_FORM_STATUS'),
        ];
    }

    /**
     * AFTER SAVE
     */
    public function afterSave($insert, $changedAttributes) {
        $this->updatePages();

        parent::afterSave($insert, $changedAttributes);
    }

}
