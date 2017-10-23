<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use app\modules\file\components\Image;
use app\modules\file\components\Video;

class BackendController extends Controller
{
	protected $imagesPath;
	protected $imagesDownloadPath;
	protected $imagesVersion;
	
	protected $post;
	
    public function behaviors()
    {
		$this->layout = '//admin';
		
		$this->imagesPath = Yii::$app->params['images']['paths']['uploadDir'];
		$this->imagesDownloadPath = Yii::$app->params['images']['paths']['downloadDir'];
		$this->imagesVersion = Yii::$app->params['images']['versions'];
		
        return [
			'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['adminPanel'], // Разрешен доступ для роли/правила "admin, user, adminPanel"
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
					'delete-image' => ['post'],
					'multi-delete' => ['post'],
                ],
            ],
        ];
    }
	
	/***************************** Загрузка, вывод картинок в редакторе **********************************/
	public function actions()
    {
        $id = 'all';
		$module = 'all';
		$imagesDirectory = '/files';
		
		$this->imagesPath = Yii::$app->params['images']['paths']['uploadDir'];
		$this->imagesDownloadPath = Yii::$app->params['images']['paths']['downloadDir'];
		
		if(Yii::$app->request->get('id')) $id = Yii::$app->request->get('id');
		if(Yii::$app->request->get('imagesDirectory')) $imagesDirectory = Yii::$app->request->get('imagesDirectory');
		
		return [
			'browse-images' => [
				'class' => 'bajadev\ckeditor\actions\BrowseAction',
				'quality' => 80,
				'maxWidth' => 800,
				'maxHeight' => 800,
				'useHash' => false,
				'url' => $this->imagesDownloadPath.$imagesDirectory.'/'.$id.'/static/', // URL адрес папки где хранятся изображения.
				'path' => $this->imagesPath.$imagesDirectory.'/'.$id.'/static/', // Или абсолютный путь к папке с изображениями.
			],
			'upload-images' => [
				'class' => 'bajadev\ckeditor\actions\UploadAction',
				'quality' => 80,
				'maxWidth' => 800,
				'maxHeight' => 800,
				'useHash' => false,
				'url' => $this->imagesDownloadPath.$imagesDirectory.'/'.$id.'/static/', // URL адрес папки где хранятся изображения.
				'path' => $this->imagesPath.$imagesDirectory.'/'.$id.'/static/', // Или абсолютный путь к папке с изображениями.
			],
		];
    }
	/***************************** /Загрузка, вывод картинок в редакторе **********************************/
	
	/***************************** Удаление картинок по AJAX **********************************/
	public function actionDeleteImage()
    {
        if (Image::deleteAsPost(Yii::$app->request->post()))
		{
			echo 'success';
        } 
		else 
		{
			echo 'error';
		}
    }
	/***************************** /Удаление картинок по AJAX **********************************/
	
	/***************************** Удаление файлов по AJAX **********************************/
	public function actionDeleteVideo()
    {
        if (Video::deleteAsPost(Yii::$app->request->post()))
		{
			echo 'success';
        } 
		else 
		{
			echo 'error';
		}
    }
	/***************************** /Удаление файлов по AJAX **********************************/
}