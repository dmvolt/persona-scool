<?php

namespace app\modules\file\models;

use Yii;
use yii\helpers\FileHelper;
use app\components\helpers\Text;
use yii\web\UploadedFile;
use app\modules\file\components\Image;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property integer $id
 * @property integer $content_id
 * @property string $module
 * @property string $filename
 * @property string $type
 * @property string $delta
 */
class File extends \yii\db\ActiveRecord
{
	const SCENARIO_IMAGE = 'image';
	const SCENARIO_VIDEO = 'video';
	const SCENARIO_VIDEO_MP4 = 'video-mp4';
	const SCENARIO_VIDEO_WEBM = 'video-webm';
	const SCENARIO_VIDEO_OGV = 'video-ogv';
	
    /**
     * TABLE NAME
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    /**
     * RULES
     */
    public function rules()
    {
        return [
			[['content_id', 'type', 'delta'], 'integer'],
			['filename', 'file', 'on' => self::SCENARIO_IMAGE, 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024*1024],
			['filename', 'file', 'on' => self::SCENARIO_VIDEO, 'extensions' => ['mp4', 'webm', 'ogv']],
			['filename', 'file', 'on' => self::SCENARIO_VIDEO_MP4, 'extensions' => 'mp4'],
			['filename', 'file', 'on' => self::SCENARIO_VIDEO_WEBM, 'extensions' => 'webm'],
			['filename', 'file', 'on' => self::SCENARIO_VIDEO_OGV, 'extensions' => 'ogv'],
			['type', 'default', 'value' => 1],
			['delta', 'default', 'value' => 0],
        ];
    }
	
	/*** Редактирование (добавление) видео-файла Mp4 для связанных таблиц БД ***/
	public function updateVideoMp4($post, $model, $id = 0, $module = '', $fileDirectory = false, $fileType = 11)
	{
		if($model->videoFileMp4 = UploadedFile::getInstance($model, 'videoFileMp4'))
		{
			/*************** Транслитерация имени файла ******************/
			$newname = Text::transliterate($model->videoFileMp4->baseName);

			if(!$fileDirectory)
			{
				$fileDirectory = $module;
			}
			
			if($model->videoMp4)
			{
				\app\modules\file\components\Video::delete($fileDirectory, $id, $model->videoMp4->filename, $model->videoMp4->id);
			}

			\app\modules\file\components\Video::load($fileDirectory, $id, $model->videoFileMp4, $newname, $model->videoFileMp4->extension);

			$fileModel = new File();
			
			$fileModel->scenario = self::SCENARIO_VIDEO_MP4;
			
			$fileModel->filename = $newname.'.'.$model->videoFileMp4->extension;
			$fileModel->content_id = $id;
			$fileModel->module = $module;
			$fileModel->type = $fileType;
			$fileModel->delta = 0;

			$fileModel->save();
		}
	}
	
	/*** Редактирование (добавление) видео-файла Webm для связанных таблиц БД ***/
	public function updateVideoWebm($post, $model, $id = 0, $module = '', $fileDirectory = false, $fileType = 12)
	{
		if($model->videoFileWebm = UploadedFile::getInstance($model, 'videoFileWebm'))
		{
			/*************** Транслитерация имени файла ******************/
			$newname = Text::transliterate($model->videoFileWebm->baseName);

			if(!$fileDirectory)
			{
				$fileDirectory = $module;
			}
			
			if($model->videoWebm)
			{
				\app\modules\file\components\Video::delete($fileDirectory, $id, $model->videoWebm->filename, $model->videoWebm->id);
			}

			\app\modules\file\components\Video::load($fileDirectory, $id, $model->videoFileWebm, $newname, $model->videoFileWebm->extension);

			$fileModel = new File();
			
			$fileModel->scenario = self::SCENARIO_VIDEO_WEBM;
			
			$fileModel->filename = $newname.'.'.$model->videoFileWebm->extension;
			$fileModel->content_id = $id;
			$fileModel->module = $module;
			$fileModel->type = $fileType;
			$fileModel->delta = 0;

			$fileModel->save();
		}
	}
	
	/*** Редактирование (добавление) видео-файла Ogv для связанных таблиц БД ***/
	public function updateVideoOgv($post, $model, $id = 0, $module = '', $fileDirectory = false, $fileType = 13)
	{
		if($model->videoFileOgv = UploadedFile::getInstance($model, 'videoFileOgv'))
		{
			/*************** Транслитерация имени файла ******************/
			$newname = Text::transliterate($model->videoFileOgv->baseName);

			if(!$fileDirectory)
			{
				$fileDirectory = $module;
			}
			
			if($model->videoOgv)
			{
				\app\modules\file\components\Video::delete($fileDirectory, $id, $model->videoOgv->filename, $model->videoOgv->id);
			}

			\app\modules\file\components\Video::load($fileDirectory, $id, $model->videoFileOgv, $newname, $model->videoFileOgv->extension);

			$fileModel = new File();
			
			$fileModel->scenario = self::SCENARIO_VIDEO_OGV;
			
			$fileModel->filename = $newname.'.'.$model->videoFileOgv->extension;
			$fileModel->content_id = $id;
			$fileModel->module = $module;
			$fileModel->type = $fileType;
			$fileModel->delta = 0;

			$fileModel->save();
		}
	}

	/*** Редактирование (добавление) картинки миниатюры для связанных таблиц БД ***/
	public function updateThumb($post, $model, $id = 0, $module = '', $imageDirectory = false, $fileType = 1)
	{
		if($model->imageFile = UploadedFile::getInstance($model, 'imageFile'))
		{
			/*************** Транслитерация имени файла ******************/
			$newname = Text::transliterate($model->imageFile->baseName);

			if(!$imageDirectory)
			{
				$imageDirectory = $module;
			}
			
			if($model->thumb)
			{
				Image::delete($imageDirectory, $id, $model->thumb->filename, $model->thumb->id);
			}

			Image::load($imageDirectory, $id, $model->imageFile, $newname, $model->imageFile->extension);

			$fileModel = new File();
			
			$fileModel->scenario = self::SCENARIO_IMAGE;
			
			$fileModel->filename = $newname.'.'.$model->imageFile->extension;
			$fileModel->content_id = $id;
			$fileModel->module = $module;
			$fileModel->type = $fileType;
			$fileModel->delta = 0;

			$fileModel->save();
		}
	}
	
	/*** Редактирование (добавление) картинки фона для связанных таблиц БД ***/
	public function updateBg($post, $model, $id = 0, $module = '', $imageDirectory = false, $fileType = 5)
	{
		if($model->bgFile = UploadedFile::getInstance($model, 'bgFile'))
		{
			/*************** Транслитерация имени файла ******************/
			$newname = Text::transliterate($model->bgFile->baseName);

			if(!$imageDirectory)
			{
				$imageDirectory = $module;
			}
			
			if($model->bg)
			{
				Image::delete($imageDirectory, $id, $model->bg->filename, $model->bg->id);
			}

			Image::load($imageDirectory, $id, $model->bgFile, $newname, $model->bgFile->extension);

			$fileModel = new File();
			
			$fileModel->scenario = self::SCENARIO_IMAGE;
			
			$fileModel->filename = $newname.'.'.$model->bgFile->extension;
			$fileModel->content_id = $id;
			$fileModel->module = $module;
			$fileModel->type = $fileType;
			$fileModel->delta = 0;

			$fileModel->save();
		}
	}
	
	/*** Редактирование (добавление) картинки2 миниатюры для связанных таблиц БД ***/
	public function updateThumb2($post, $model, $id = 0, $module = '', $imageDirectory = false, $fileType = 4)
	{
		if($model->imageFile2 = UploadedFile::getInstance($model, 'imageFile2'))
		{
			/*************** Транслитерация имени файла ******************/
			$newname = Text::transliterate($model->imageFile2->baseName);

			if(!$imageDirectory)
			{
				$imageDirectory = $module;
			}
			
			if($model->thumb2)
			{
				Image::delete($imageDirectory, $id, $model->thumb2->filename, $model->thumb2->id);
			}

			Image::load($imageDirectory, $id, $model->imageFile2, $newname, $model->imageFile2->extension);

			$fileModel = new File();
			
			$fileModel->scenario = self::SCENARIO_IMAGE;
			
			$fileModel->filename = $newname.'.'.$model->imageFile2->extension;
			$fileModel->content_id = $id;
			$fileModel->module = $module;
			$fileModel->type = $fileType;
			$fileModel->delta = 0;

			$fileModel->save();
		}
	}

	/*** Редактирование (добавление) Логотипа ***/
	public function updateLogo($post, $model, $id = 1, $module = 'main', $imageDirectory = false, $fileType = 1)
	{
		if($model->logoFile = UploadedFile::getInstance($model, 'logoFile'))
		{
			/*************** Транслитерация имени файла ******************/
			$newname = Text::transliterate($model->logoFile->baseName);

			if(!$imageDirectory)
			{
				$imageDirectory = $module;
			}
			
			if($model->logo)
			{
				Image::delete($imageDirectory, $id, $model->logo->filename, $model->logo->id);
			}

			Image::load($imageDirectory, $id, $model->logoFile, $newname, $model->logoFile->extension);

			$fileModel = new File();
			
			$fileModel->scenario = self::SCENARIO_IMAGE;
			
			$fileModel->filename = $newname.'.'.$model->logoFile->extension;
			$fileModel->content_id = $id;
			$fileModel->module = $module;
			$fileModel->type = $fileType;
			$fileModel->delta = 0;

			$fileModel->save();
		}
	}

	/*** Редактирование (добавление) файлов для связанных таблиц БД ***/
	public function updateFiles($post, $model, $id = 0, $module = '', $imageDirectory = false, $fileType = 2)
	{
		if($model->imageGallery = UploadedFile::getInstances($model, 'imageGallery'))
		{
			if(!$imageDirectory)
			{
				$imageDirectory = $module;
			}
			
			foreach($model->imageGallery as $delta => $gallery)
			{
				/*************** Транслитерация имени файла ******************/
				$newname = Text::transliterate($gallery->baseName);

				Image::load($imageDirectory, $id, $gallery, $newname, $gallery->extension);

				$fileModel = new File();
				
				$fileModel->scenario = self::SCENARIO_IMAGE;
				
				$fileModel->filename = $newname.'.'.$gallery->extension;
				$fileModel->content_id = $id;
				$fileModel->module = $module;
				$fileModel->type = $fileType;
				$fileModel->delta = $delta;

				$fileModel->save();
			}
		}
		elseif($model->files)
		{
			foreach($model->files as $item)
			{
				$fileModel = File::findOne($item->id);
				
				$fileModel->scenario = self::SCENARIO_IMAGE;
				
				$fileModel->delta = $post['imageAttr'][$item->id]['delta'];
				$fileModel->alt = $post['imageAttr'][$item->id]['alt'];
				$fileModel->title = $post['imageAttr'][$item->id]['title'];
				$fileModel->save();
			}
		}
	}

	/*** Редактирование (добавление) Favicon ***/
	public function updateIcon($post, $model, $id = 1, $module = 'main', $fileType = 3)
	{
		if($model->iconFile = UploadedFile::getInstance($model, 'iconFile'))
		{
			if($model->icon)
			{
				Image::delete($module, $id, 'favicon.ico', $model->icon->id);
			}

			Image::load($module, $id, $model->iconFile, 'favicon', 'ico');

			$fileModel = new File();
			
			$fileModel->scenario = self::SCENARIO_IMAGE;
			
			$fileModel->filename = 'favicon.ico';
			$fileModel->content_id = $id;
			$fileModel->module = $module;
			$fileModel->type = $fileType;
			$fileModel->delta = 0;

			$fileModel->save();
		}
	}
	
	/****** Удаление файлов и записей из связанных таблиц БД ********/
	public function deleteFiles($id = 0, $module = '', $imageDirectory = false, $paramFile = 'images')
	{
		if(!$imageDirectory)
		{
			$imageDirectory = $module;
		}
		// Удаляем записи в базе данных
		if(File::deleteAll(['module' => $module, 'content_id' => $id]))
		{
			// Удаляем все файлы материала
			FileHelper::removeDirectory(Yii::getAlias(Yii::$app->params[$paramFile]['paths']['uploadDir'].$imageDirectory.'/'.$id.'/'));
		}
	}
}
