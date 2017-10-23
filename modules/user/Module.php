<?php

namespace app\modules\user;

use Yii;

/**
 * user module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * ���������� �������� ������ (�� ��������� �������� ������)
     */
    public $imagesDirectory = 'user';

    /**
     * ���� �� ���������
     */
    public $defaultRole = 'user';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\user\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
		
		// ���������� ������ profile ��� ����, ����� �������� ����������� �� ������ profile � ���� ������
		Yii::$app->getModule('profile');

        // custom initialization code goes here
        Yii::$app->i18n->translations['modules/user/*'] =
            [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'forceTranslation' => true,
                'basePath' => '@app/modules/user/messages',
                'fileMap' => [
                    'modules/user/module' => 'module.php',
                ],
            ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/user/' . $category, $message, $params, $language);
    }
}
