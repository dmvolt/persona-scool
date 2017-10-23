<?php

namespace app\modules\service\controllers;

use app\controllers\FrontendController;
use app\modules\service\models\Service;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;

use yii\data\ActiveDataProvider;

use Yii;

/**
 * Default controller for the `service` module
 */
class DefaultController extends FrontendController
{
	/**
     * Renders the view for the module
     * @return string
     */
    public function actionView($alias = '')
    {
		$service = Service::find()
				->with('seo')
				->with('thumb')
				->where(['status' => 1, 'alias' => $alias])
				->one();
		
		if ($service) {
			
            $this->view->title = $service->title;
			/******************** SEO ************************/
			if($service->seo && !empty($service->seo->meta_title))
			{
				$this->view->title = $service->seo->meta_title;
			} 
			else 
			{
				$this->view->title = $service->title;
			}
			
			if($service->seo && !empty($service->seo->meta_desc))
			{
				$this->view->params['meta_description'] = $service->seo->meta_desc;
			} 
			else 
			{
				$this->view->params['meta_description'] = $service->teaser;
			}
			
			if($service->seo && !empty($service->seo->meta_key))
			{
				$this->view->params['meta_keywords'] = $service->seo->meta_key;
			}
			/******************** /SEO ***********************/
			return $this->render('/one-service', ['service' => $service]);
        } else {
            throw new NotFoundHttpException('404 Страница не найдена.');
        }
    }
	
	public function actionIndex()
    {
		$query = Service::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => 10,
			],
        ]);
		
		$query->andFilterWhere(['status' => 1])
			->orderBy('weight');
			
			
		$articles = $dataProvider->getModels();
		$pagination = $dataProvider->getPagination();
		
		if ($articles) {
		
            $this->view->title = 'Наши программы';
			$this->view->params['title_h1'] = 'Наши программы';
			
        }
		
		return $this->render('/service', [
			'dataProvider' => $dataProvider, 
			'articles' => $articles, 
			'pagination' => $pagination,
		]);
    }
}