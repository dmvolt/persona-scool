<?php

namespace app\modules\search;
use Yii;

/**
 * search module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * ���������� �������� ������ (�� ��������� �������� ������)
     */
    public $imagesDirectory = 'search';
	
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\search\controllers';
	
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
		
		// ���������� ������ service ��� ����, ����� �������� ����������� �� ������ search � ���� ������
		Yii::$app->getModule('service');
		Yii::$app->getModule('article');
		Yii::$app->getModule('action');
		Yii::$app->getModule('page');
		Yii::$app->getModule('faq');
		Yii::$app->getModule('review');
		Yii::$app->getModule('team');
		
        // custom initialization code goes here
        Yii::$app->i18n->translations['modules/search/*'] =
            [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'forceTranslation' => true,
                'basePath' => '@app/modules/search/messages',
                'fileMap' => [
                    'modules/search/module' => 'module.php',
                ],
            ];
    }
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/search/' . $category, $message, $params, $language);
    }
}