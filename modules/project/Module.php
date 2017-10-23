<?php
namespace app\modules\project;

use Yii;
/**
 * project module definition class
 */
class Module extends \yii\base\Module
{
	/**
     * Директория картинок модуля (по умолчанию название модуля)
     */
	public $imagesDirectory = 'project';
	
	/**
     * Директория видеофайлов модуля (по умолчанию название модуля)
     */
	public $videoDirectory = 'project';
	
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\project\controllers';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

		// custom initialization code goes here
		Yii::$app->i18n->translations['modules/project/*'] = 
        [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'forceTranslation' => true,
            'basePath' => '@app/modules/project/messages',
            'fileMap' => [
                'modules/project/module' => 'module.php',
            ],
        ];
    }
	
	public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/project/' . $category, $message, $params, $language);
    }
}