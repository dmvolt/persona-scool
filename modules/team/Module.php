<?php
namespace app\modules\team;
use Yii;
/**
 * team module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * ���������� �������� ������ (�� ��������� �������� ������)
     */
    public $imagesDirectory = 'team';
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\team\controllers';
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        // custom initialization code goes here
        Yii::$app->i18n->translations['modules/team/*'] =
            [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'forceTranslation' => true,
                'basePath' => '@app/modules/team/messages',
                'fileMap' => [
                    'modules/team/module' => 'module.php',
                ],
            ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/team/' . $category, $message, $params, $language);
    }
}