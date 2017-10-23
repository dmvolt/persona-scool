<?php

namespace app\modules\preference\controllers;

use yii\data\ActiveDataProvider;

use app\controllers\FrontendController;
use app\modules\preference\models\Preference;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;
use Yii;

/**
 * Default controller for the `preference` module
 */
class DefaultController extends FrontendController
{
	/**
     * Renders the view for the module
     * @return string
     */
    public function actionView($alias = '')
    {
		$preference = Preference::find()
				->with('seo')
				->with('thumb')
				->with('files')
				->where(['status' => 1, 'alias' => $alias])
				->one();
		
		if ($preference) 
		{
            $this->view->title = $preference->title;
			
			/******************** SEO ************************/
			if($preference->seo) {
				if (!empty($preference->seo->meta_title)) {
					$this->view->title = $preference->seo->meta_title;
				}

				if (!empty($preference->seo->meta_desc)) {
					$this->view->params['meta_description'] = $preference->seo->meta_desc;
				}

				if (!empty($preference->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $preference->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
			return $this->render('/preference', ['preference' => $preference]);
        } 
		else 
		{
            throw new NotFoundHttpException('404 Страница не найдена.');
        }
    }
	
    /**
     * Renders the index for the module
     * @return string
     */
    public function actionIndex()
    {
		$query = Preference::find()
				->with('seo')
				->with('thumb')
				->with('files')
				->where(['status' => 1])
				->orderBy('weight');
				
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => 10
			],
        ]);
		
		$preferences = $dataProvider->getModels();
		$pagination = $dataProvider->getPagination();
		
		if ($preferences) {
            $this->view->title = 'Преимущества';
			
			/******************** SEO ************************/
			if($preferences[0]->seo) {
				if (!empty($preferences[0]->seo->meta_title)) {
					$this->view->title = $preferences[0]->seo->meta_title;
				}

				if (!empty($preferences[0]->seo->meta_desc)) {
					$this->view->params['meta_description'] = $preferences[0]->seo->meta_desc;
				}

				if (!empty($preferences[0]->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $preferences[0]->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
        }
		return $this->render('/preferences', ['preferences' => $preferences, 'pagination' => $pagination]);
    }
}