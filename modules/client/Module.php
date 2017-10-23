<?php
namespace app\modules\client;
use Yii;
/**
 * client module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * Директория картинок модуля (по умолчанию название модуля)
     */
    public $imagesDirectory = 'client';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\client\controllers';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
        Yii::$app->i18n->translations['modules/client/*'] =
            [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'forceTranslation' => true,
                'basePath' => '@app/modules/client/messages',
                'fileMap' => [
                    'modules/client/module' => 'module.php',
                ],
            ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/client/' . $category, $message, $params, $language);
    }
}