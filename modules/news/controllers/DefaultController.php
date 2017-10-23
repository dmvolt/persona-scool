<?php

namespace app\modules\news\controllers;

use app\controllers\FrontendController;
use app\modules\news\models\News;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;

use yii\data\ActiveDataProvider;

use Yii;

/**
 * Default controller for the `news` module
 */
class DefaultController extends FrontendController
{
	/**
     * Renders the view for the module
     * @return string
     */
    public function actionView($alias = '')
    {
		$news = News::find()->where(['status' => 1, 'alias' => $alias])->one();
		$mainNews = News::find()->where(['is_main' => 1])->one();
		
		$this->view->params['title_module'] = 'Новости';
		/******************** MAIN ************************/
		if($mainNews->seo) {
			if (!empty($mainNews->seo->title_h1)) {
				$this->view->params['title_module'] = $mainNews->seo->title_h1;
			}
		}
		/******************** /MAIN ***********************/
		
		if ($news) 
		{
            $this->view->title = $news->title;
			$this->view->params['title_h1'] = $news->title;
			/******************** SEO ************************/
			if($news->seo) {
				if (!empty($news->seo->meta_title)) {
					$this->view->title = $news->seo->meta_title;
				}
				
				if (!empty($news->seo->title_h1)) {
					$this->view->params['title_h1'] = $news->seo->title_h1;
				}

				if (!empty($news->seo->meta_desc)) {
					$this->view->params['meta_description'] = $news->seo->meta_desc;
				}

				if (!empty($news->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $news->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
			
			return $this->render('/news', ['news' => $news]);
			
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
		$query = News::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => SIZE10
			],
        ]);
		
		$query->andFilterWhere(['is_main' => 0])
			->andFilterWhere(['status' => 1])
			->orderBy(['date' => SORT_DESC]);
			
			
		$news = $dataProvider->getModels();
		$pagination = $dataProvider->getPagination();
		
		$mainNews = News::find()->where(['is_main' => 1])->one();
		
		if ($mainNews) {
		
            $this->view->title = 'Новости';
			$this->view->params['title_h1'] = 'Новости';
			
			/******************** SEO ************************/
			if($mainNews && $mainNews->seo) {
				if (!empty($mainNews->seo->meta_title)) {
					$this->view->title = $mainNews->seo->meta_title;
				}
				if (!empty($mainNews->seo->title_h1)) {
					$this->view->params['title_h1'] = $mainNews->seo->title_h1;
				}
				if (!empty($mainNews->seo->meta_desc)) {
					$this->view->params['meta_description'] = $mainNews->seo->meta_desc;
				}
				if (!empty($mainNews->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $mainNews->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
        }
		
		return $this->render('/all-news', [
			'dataProvider' => $dataProvider, 
			'news' => $news, 
			'mainNews' => $mainNews,
			'pagination' => $pagination,
		]);
    }
}