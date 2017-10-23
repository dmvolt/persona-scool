<?php
namespace app\modules\news;

use Yii;
/**
 * news module definition class
 */
class Module extends \yii\base\Module
{
	/**
     * Директория картинок модуля (по умолчанию название модуля)
     */
	public $imagesDirectory = 'news';
	
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\news\controllers';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

		// custom initialization code goes here
		Yii::$app->i18n->translations['modules/news/*'] = 
        [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'forceTranslation' => true,
            'basePath' => '@app/modules/news/messages',
            'fileMap' => [
                'modules/news/module' => 'module.php',
            ],
        ];
    }
	
	public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/news/' . $category, $message, $params, $language);
    }
}