<?php

namespace app\modules\banner\models;

use Yii;
use app\modules\banner\Module;

/********** USE MODELS *********/
use app\modules\banner\models\Banner;

/**
 * This is the model class for table "{{%banner_page}}".
 *
 * @property string $id
 * @property string $banner_id
 * @property string $location
 */
class BannerPage extends Banner
{
	/**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%banner_page}}';
    }
	
	/**
     * BANNER INFO
     */
	public function getBanner()
    {
        return $this->hasOne(Banner::className(), ['id' => 'banner_id']);
    }
	
    /**
     * RULES
     */
    public function rules()
    {
        return [
            [['banner_id', 'location'], 'required'],
			[['banner_id'], 'integer'],
            [['location'], 'string'],
        ];
    }
}