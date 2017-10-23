<?php

namespace app\modules\service\models;

use Yii;
use app\components\helpers\Text;
use app\modules\service\Module;

/********** USE MODELS *********/
use app\modules\seo\models\Seo;
use app\modules\file\models\File;

/**
 * This is the model class for table "{{%service}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $title
 * @property string $teaser
 * @property string $teaser2
 * @property string $body
 * @property string $text1
 * @property string $text2
 * @property string $text3
 * @property string $alias
 * @property string $color
 * @property string $weight
 * @property string $in_front
 * @property integer $status
 */
class Service extends \yii\db\ActiveRecord
{
	public $level = 0; // Коэфицент вложенности
	public $imageFile;	
	public $imageFile2;
	public $post;
	
	private $_servicesArray;
	
	/**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%service}}';
    }
	
    public static function getName($id = 0)
    {
		if (($model = Service::findOne($id)) !== null) {
            return $model->title;
        } else {
            return null;
        }
    }
	
	/**
     * COLOR
     */
	public static function getColorArray()
    {
        return [
            '1' => 'Желтый',
			'2' => 'Зеленый',
            '3' => 'Синий',
			'4' => 'Фиолетовый',
			'5' => 'Красный',
        ];
    }
	
    /**
     * SEO
     */
    public function getSeo()
    {
        return $this->hasOne(Seo::className(), ['content_id' => 'id'])
            ->where(['module' => 'service']);
    }
	
	/**
     * CHILDREN Дочерние материалы
     */
	public function getChildren()
    {
        return $this->hasMany(Service::className(), ['id' => 'child_id'])
            ->viaTable('service_service', ['parent_id' => 'id']);
    }
	
	/**
     * PARENT Родительский материал
     */
	public function getParent()
    {
        return $this->hasMany(Service::className(), ['id' => 'parent_id'])
            ->viaTable('service_service', ['child_id' => 'id']);
    }
	
	/**
     * UPDATE PARENTS
     */
    private function updateParents()
    {
        $currentServiceIds = $this->getParent()->select('id')->column();
        $newServiceIds = $this->getServicesArray();
        foreach (array_filter(array_diff($newServiceIds, $currentServiceIds)) as $serviceId) {
            /** @var Service $service */
            if ($service = Service::findOne($serviceId)) {
                $this->link('parent', $service);
            }
        }
        foreach (array_filter(array_diff($currentServiceIds, $newServiceIds)) as $serviceId) {
            /** @var Service $service */
            if ($service = Service::findOne($serviceId)) {
                $this->unlink('parent', $service, true);
            }
        }
    }
	
	public function getServicesArray()
    {
        if ($this->_servicesArray === null) {
            $this->_servicesArray = $this->getParent()->select('id')->column();
        }
        return $this->_servicesArray;
    }
	
	public function setServicesArray($value)
    {
        $this->_servicesArray = (array)$value;
    }
    
    /**
     * THUMBNAIL1 IMAGE
     */
	public function getThumb($type = 1)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'service']);
    }
	
	/**
     * THUMBNAIL2 IMAGE
     */
	public function getThumb2($type = 4)
    {
        return $this->hasOne(File::className(), ['content_id' => 'id'])
			->where(['type' => $type, 'module' => 'service']);
    }
	
    /**
     * RULES
     */
    public function rules()
    {
		$this->post = Yii::$app->request->post('Service');
        return [
            [['title', 'status'], 'required'],
            [['teaser', 'teaser2', 'body', 'alias', 'text1', 'text2', 'text3', 'color'], 'string'],
            [['weight', 'status', 'parent_id', 'in_front'], 'integer'],
			[['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2],
			[['imageFile2'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => (1024*1024)*2],
            [['title'], 'string', 'max' => 255],
			
			[['servicesArray'], 'safe'],
			
			[['weight'], 'default', 'value' => 0],
			[['parent_id'], 'default', 'value' => 0],
			[['in_front'], 'default', 'value' => 0],
		
			[['alias'], 'default', 'value' => Text::transliterate($this->post['title'])],
        ];
    }
    /**
     * LABELS
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('module', 'SERVICE_BACK_FORM_ID'),
			'parent_id' => Module::t('module', 'SERVICE_BACK_FORM_PARENTID'),
			'title' => Module::t('module', 'SERVICE_BACK_FORM_TITLE'),
			'imageFile' => Module::t('module', 'SERVICE_BACK_FORM_FILE'),
			'imageFile2' => Module::t('module', 'SERVICE_BACK_FORM_FILE2'),
            'teaser' => Module::t('module', 'SERVICE_BACK_FORM_TEASER1'),
			'teaser2' => Module::t('module', 'SERVICE_BACK_FORM_TEASER2'),
            'body' => Module::t('module', 'SERVICE_BACK_FORM_BODY'),
			'text1' => Module::t('module', 'SERVICE_BACK_FORM_TEXT1'),
			'text2' => Module::t('module', 'SERVICE_BACK_FORM_TEXT2'),
			'text3' => Module::t('module', 'SERVICE_BACK_FORM_TEXT3'),
            'alias' => Module::t('module', 'SERVICE_BACK_FORM_ALIAS'),
			'color' => Module::t('module', 'SERVICE_BACK_FORM_COLOR'),
            'weight' => Module::t('module', 'SERVICE_BACK_FORM_WEIGHT'),
			'in_front' => Module::t('module', 'SERVICE_BACK_FORM_IN_FRONT'),
            'status' => Module::t('module', 'SERVICE_BACK_FORM_STATUS'),
        ];
    }
	
	/**
     * AFTER SAVE
     */
	public function afterSave($insert, $changedAttributes)
    {
        $this->updateParents();
        parent::afterSave($insert, $changedAttributes);
    }
}