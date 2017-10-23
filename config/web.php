<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'app',
	'name' => 'ИнвестКапиталСтрой',
	'language' => 'ru-RU',
	'defaultRoute' => 'main/default/index', // Default controller
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'modules' => [
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
		'banner' => [
            'class' => 'app\modules\banner\Module',
        ],
		'user' => [
            'class' => 'app\modules\user\Module',
        ],
		'profile' => [
            'class' => 'app\modules\profile\Module',
        ],
		'infoblock' => [
            'class' => 'app\modules\infoblock\Module',
        ],
		'menu' => [
            'class' => 'app\modules\menu\Module',
        ],
		'page' => [
            'class' => 'app\modules\page\Module',
        ],
		/* 'service' => [
            'class' => 'app\modules\service\Module',
        ], */
		// Статьи
		'article' => [
            'class' => 'app\modules\article\Module',
        ],
		// Объекты
		'project' => [
            'class' => 'app\modules\project\Module',
        ],
		// Новости
		'news' => [
            'class' => 'app\modules\news\Module',
        ],
		// Участки
		'area' => [
            'class' => 'app\modules\area\Module',
        ],
		// Сотрудники
		/* 'team' => [
            'class' => 'app\modules\team\Module',
        ], */
		
		// Акции
		'action' => [
            'class' => 'app\modules\action\Module',
        ],
		
		// Сертификаты
		'sert' => [
            'class' => 'app\modules\sert\Module',
        ],
		
		// Отзывы
		/* 'review' => [
            'class' => 'app\modules\review\Module',
        ], */
		// Клиенты
		'client' => [
            'class' => 'app\modules\client\Module',
        ],
		// Партнеры
		'partner' => [
            'class' => 'app\modules\partner\Module',
        ],
		/* 
		'preference' => [
            'class' => 'app\modules\preference\Module',
        ], */
		'search' => [
            'class' => 'app\modules\search\Module',
        ],
		'seo' => [
            'class' => 'app\modules\seo\Module',
        ],
		'file' => [
            'class' => 'app\modules\file\Module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4Lkqb6y7ZPz18WN1JDieAGCFQVtELqhq',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
			'loginUrl' => ['user/default/login'], // Login action
        ],
        'errorHandler' => [
            'errorAction' => 'frontend/error', // Error action
        ],
		'formatter' => [
			'datetimeFormat' => 'dd.MM.yyyy H:i',
			'dateFormat' => 'dd.MM.yyyy',
			'timeFormat' => 'H:i',
			'decimalSeparator' => ',',
			'thousandSeparator' => ' ',
			'currencyCode' => 'RU',
		],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
				
				// Главная страница сайта
				'' => 'main/default/index',
				
				// Главная страница админки
				'admin' => 'main/backend/main/index',
				
				// общие для всех модулей операции в админке
				'preadmin/<_a>' => '/backend/<_a>',
				
				// Навигация в админке
				'admin/<_m:[\w\-]+>' => '<_m>/backend/default/index',
				'admin/<_m:[\w\-]+>/setting' => '<_m>/backend/setting/index',
				
				'admin/<_m:[\w\-]+>/<_a:[\w-]+>' => '<_m>/backend/default/<_a>',
				'admin/<_m:[\w\-]+>/setting/<_a:[\w-]+>' => '<_m>/backend/setting/<_a>',
				
				'admin/<_m:[\w\-]+>/<_a:[\w-]+>/<id:\d+>' => '<_m>/backend/default/<_a>',
				'admin/<_m:[\w\-]+>/setting/<_a:[\w-]+>/<id:\d+>' => '<_m>/backend/setting/<_a>',
				
				// Загрузка и извлечение картинок в редакторе Redactor Imperavi
				'backend/images-get' => 'backend/images-get',
				'backend/image-upload' => 'backend/image-upload',
				
				// Загрузка и извлечение файлов в редакторе Redactor Imperavi
				'backend/files-get' => 'backend/files-get',
				'backend/file-upload' => 'backend/file-upload',
				
				// Страница ошибок
                '<_a:error>' => 'frontend/<_a>',
				
				// Авторизация, Регистрация и прочие действия с пользователями
                //'user/<_a:[\w\-]+>' => 'user/default/<_a>',
				
				// Авторизация, Регистрация и прочие действия с пользователями
                'account' => 'user/default/index',
				'account/<_a:[\w\-]+>' => 'user/default/<_a>',
				
				// Страница результатов поиска
                'search' => 'search/default/index',
				
				// Услуги Service
				//'services' => 'service/default/index',
				/* 'services/<cat1:[\w\-]+>' => 'service/default/index',
				'services/<cat1:[\w\-]+>/<cat2:[\w\-]+>' => 'service/default/index',
				'services/<cat1:[\w\-]+>/<cat2:[\w\-]+>/<cat3:[\w\-]+>' => 'service/default/index',
				'services/<cat1:[\w\-]+>/<cat2:[\w\-]+>/<cat3:[\w\-]+>/<cat4:[\w\-]+>' => 'service/default/index', */
				
				//'services/<alias:[\w\-]+>' => 'service/default/view',
				
				// Партнеры Partners
				'partners' => 'partner/default/index',
				'partners/<alias:[\w\-]+>' => 'partner/default/view',
				
				// Объекты Project
				'objects' => 'project/default/index',
				'objects/<alias:[\w\-]+>' => 'project/default/view',
				
				// Новости News
				'news' => 'news/default/index',
				'news/<alias:[\w\-]+>' => 'news/default/view',
				
				// Участки Area
				'areas' => 'area/default/index',
				'areas/<alias:[\w\-]+>' => 'area/default/view',
				
				// Сертификаты Sert
				'serts' => 'sert/default/index',
				
				// Сотрудники Team
				/* 'team' => 'team/default/index',
				'team/<alias:[\w\-]+>' => 'team/default/view', */
				
				// Акции Action
				/* 'actions' => 'action/default/index',
				'actions/<alias:[\w\-]+>' => 'action/default/view', */
				
				// Статьи Article
				/* 'articles' => 'article/default/index',
				'articles/<alias:[\w\-]+>' => 'article/default/view', */
				
				// Отзывы Review
				/* 'reviews' => 'review/default/index',
				'reviews/<alias:[\w\-]+>' => 'review/default/view', */
				
				/* 'services' => 'service/default/index',
				'<cat:[\w\-]+>' => 'service/default/index', */
				
				// Страницы Page
				'<alias:[\w\-]+>' => 'page/default/index',
				'<alias:(contacts)>' => 'page/default/index',
				
				// Правила по умолчанию
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w-]+>' => '<_m>/<_c>/<_a>',
				'<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
				'<_m:[\w\-]+>' => '<_m>/default/index',
				'<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
            ],
        ],
        'authManager' => [
            'class' => 'app\modules\user\components\AuthManager',
        ],
/***************************** Настройка Ресурсов Assets ******************************************/
		'assetManager' => [
			'linkAssets' => false, // Использование символических ссылок вместо копирования файлов в веб директорию /assets (не все серверы позволяют это сделать)
            'appendTimestamp' => true, // Добавление временной метки в путь до файла для актуализации подгружаемых файлов всвязи с HTTP кэшированием
			'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // не опубликовывать встроенный по умолчанию комплект
                    'js' => [
                        'js/vendor/jquery.min.js',
                    ],
					'jsOptions' => ['position' => \yii\web\View::POS_HEAD], // подключить файл в области HEAD
                ],
            ],
        ],
/***************************** /Настройка Ресурсов Assets ****************************************/
		'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'forceTranslation' => true, // Принудительный перевод при использовании идентификаторов, 
					// в противном случае, если используется язык по умолчанию перевод осуществляться не будет
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
	
	$config['modules']['debug']['allowedIPs'] = ['*']; // Доступ по IP адресу "*" - означает все адреса разрешены

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
