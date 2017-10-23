<?php
namespace app\modules\sert;

use Yii;
/**
 * sert module definition class
 */
class Module extends \yii\base\Module
{
	/**
     * Директория картинок модуля (по умолчанию название модуля)
     */
	public $imagesDirectory = 'sert';
	
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\sert\controllers';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

		// custom initialization code goes here
		Yii::$app->i18n->translations['modules/sert/*'] = 
        [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'forceTranslation' => true,
            'basePath' => '@app/modules/sert/messages',
            'fileMap' => [
                'modules/sert/module' => 'module.php',
            ],
        ];
    }
	
	public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/sert/' . $category, $message, $params, $language);
    }
}