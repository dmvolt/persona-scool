<?php
namespace app\modules\photo\controllers;

use app\controllers\FrontendController;
use app\modules\photo\models\Photo;

use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;

use Yii;
use app\modules\main\models\forms\FormContact;

/**
 * Default controller for the `photo` module
 */
class DefaultController extends FrontendController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($alias = '')
    {
		$photo = Photo::find()
				->with('seo')
				->with('thumb')
				->with('files')
				->where(['status' => 1, 'alias' => $alias])
				->one();
		
		if ($photo) {
		
            $this->view->title = $photo->title;
			
			/******************** SEO ************************/
			if($photo->seo)
			{
				if (!empty($photo->seo->meta_title))
				{
					$this->view->title = $photo->seo->meta_title;
				}

				if (!empty($photo->seo->meta_desc))
				{
					$this->view->params['meta_description'] = $photo->seo->meta_desc;
				}

				if (!empty($photo->seo->meta_key))
				{
					$this->view->params['meta_keywords'] = $photo->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
			
			return $this->render('/photo', ['photo' => $photo]);
			
        } else {
            throw new NotFoundHttpException('404 Страница не найдена.');
        }
    }
}
