<?php
namespace app\modules\photo;
use Yii;
/**
 * photo module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * Директория картинок модуля (по умолчанию название модуля)
     */
    public $imagesDirectory = 'photo';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\photo\controllers';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
        Yii::$app->i18n->translations['modules/photo/*'] =
            [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'forceTranslation' => true,
                'basePath' => '@app/modules/photo/messages',
                'fileMap' => [
                    'modules/photo/module' => 'module.php',
                ],
            ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/photo/' . $category, $message, $params, $language);
    }
}