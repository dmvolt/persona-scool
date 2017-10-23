<?php

namespace app\modules\infoblock;

use Yii;

/**
 * infoblock module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * ���������� �������� ������ (�� ��������� �������� ������)
     */
    public $imagesDirectory = 'infoblock';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\infoblock\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        Yii::$app->i18n->translations['modules/infoblock/*'] =
            [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'forceTranslation' => true,
                'basePath' => '@app/modules/infoblock/messages',
                'fileMap' => [
                    'modules/infoblock/module' => 'module.php',
                ],
            ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/infoblock/' . $category, $message, $params, $language);
    }
}
