<?php
namespace app\modules\area;

use Yii;
/**
 * area module definition class
 */
class Module extends \yii\base\Module
{
	/**
     * Директория картинок модуля (по умолчанию название модуля)
     */
	public $imagesDirectory = 'area';
	
	/**
     * Директория видеофайлов модуля (по умолчанию название модуля)
     */
	public $videoDirectory = 'area';
	
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\area\controllers';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

		// custom initialization code goes here
		Yii::$app->i18n->translations['modules/area/*'] = 
        [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'forceTranslation' => true,
            'basePath' => '@app/modules/area/messages',
            'fileMap' => [
                'modules/area/module' => 'module.php',
            ],
        ];
    }
	
	public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/area/' . $category, $message, $params, $language);
    }
}