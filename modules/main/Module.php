<?php

namespace app\modules\main;

use Yii;

/**
 * main module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * ���������� �������� ������ (�� ��������� �������� ������)
     */
    public $imagesDirectory = 'main';
	
	/**
     * ���������� ����������� ������ (�� ��������� �������� ������)
     */
    public $videoDirectory = 'main';
    
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\main\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        Yii::$app->i18n->translations['modules/main/*'] =
            [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'forceTranslation' => true,
                'basePath' => '@app/modules/main/messages',
                'fileMap' => [
                    'modules/main/module' => 'module.php',
                ],
            ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/main/' . $category, $message, $params, $language);
    }
}
