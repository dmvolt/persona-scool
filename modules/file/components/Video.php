<?php

namespace app\modules\file\components;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use app\modules\file\models\File;

class Video
{
	public static function load($moduleFileDir, $contentId, $model, $filename, $ext = 'jpg')
	{
		$ext = strtolower($ext);
		
		$filePath = Yii::$app->params['video']['paths']['uploadDir'];

		FileHelper::createDirectory(Yii::getAlias($filePath . $moduleFileDir . '/' . $contentId . '/'));
		$model->saveAs(Yii::getAlias($filePath . $moduleFileDir . '/' . $contentId . '/' . $filename . '.' . $ext));
	}
	
	public static function deleteAsPost($postRequest = false)
	{
		$return = false;
		
		if ($postRequest)
		{
			$filePath = Yii::$app->params['video']['paths']['uploadDir'];
			
			$success = is_file(Yii::getAlias($filePath.$postRequest['fileDirectory'].'/'.$postRequest['contentId'].'/'.$postRequest['fileName'])) && unlink(Yii::getAlias($filePath.$postRequest['fileDirectory'].'/'.$postRequest['contentId'].'/'.$postRequest['fileName']));
			if ($success) {
				File::findOne($postRequest['fileId'])->delete();
			}
			$return = true;
        } 
		return $return;
	}
	
	public static function delete($moduleFileDir = '', $contentId = 0, $fileName = '', $fileId = 0)
	{
		$return = false;
		
		$filePath = Yii::$app->params['video']['paths']['uploadDir'];
		
		$success = is_file(Yii::getAlias($filePath.$moduleFileDir.'/'.$contentId.'/'.$fileName)) && unlink(Yii::getAlias($filePath.$moduleFileDir.'/'.$contentId.'/'.$fileName));
		if ($success)
		{
			File::findOne($fileId)->delete();
			$return = true;
		}
		return $return;
	}
}