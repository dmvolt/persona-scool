<?php

namespace app\modules\article\controllers;

use app\controllers\FrontendController;
use app\modules\article\models\Article;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;

use yii\data\ActiveDataProvider;

use Yii;

/**
 * Default controller for the `article` module
 */
class DefaultController extends FrontendController
{
	/**
     * Renders the view for the module
     * @return string
     */
    public function actionView($alias = '')
    {
		$article = Article::find()->where(['status' => 1, 'alias' => $alias])->one();
		$mainArticle = Article::find()->where(['is_main' => 1])->one();
		
		$this->view->params['title_module'] = 'Статьи';
		/******************** MAIN ************************/
		if($mainArticle->seo) {
			if (!empty($mainArticle->seo->title_h1)) {
				$this->view->params['title_module'] = $mainArticle->seo->title_h1;
			}
		}
		/******************** /MAIN ***********************/
		
		if ($article) 
		{
            $this->view->title = $article->title;
			$this->view->params['title_h1'] = $article->title;
			/******************** SEO ************************/
			if($article->seo) {
				if (!empty($article->seo->meta_title)) {
					$this->view->title = $article->seo->meta_title;
				}
				
				if (!empty($article->seo->title_h1)) {
					$this->view->params['title_h1'] = $article->seo->title_h1;
				}

				if (!empty($article->seo->meta_desc)) {
					$this->view->params['meta_description'] = $article->seo->meta_desc;
				}

				if (!empty($article->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $article->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
			
			return $this->render('/article', ['article' => $article]);
			
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
		$query = Article::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => SIZE10
			],
        ]);
		
		$query->andFilterWhere(['is_main' => 0])
			->andFilterWhere(['status' => 1])
			->orderBy(['date' => SORT_DESC]);
			
			
		$articles = $dataProvider->getModels();
		$pagination = $dataProvider->getPagination();
		
		$mainArticle = Article::find()->where(['is_main' => 1])->one();
		
		if ($articles) {
		
            $this->view->title = 'Статьи';
			$this->view->params['title_h1'] = 'Статьи';
			
			/******************** SEO ************************/
			if($mainArticle && $mainArticle->seo) {
				if (!empty($mainArticle->seo->meta_title)) {
					$this->view->title = $mainArticle->seo->meta_title;
				}
				if (!empty($mainArticle->seo->title_h1)) {
					$this->view->params['title_h1'] = $mainArticle->seo->title_h1;
				}
				if (!empty($mainArticle->seo->meta_desc)) {
					$this->view->params['meta_description'] = $mainArticle->seo->meta_desc;
				}
				if (!empty($mainArticle->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $mainArticle->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
        }
		
		return $this->render('/articles', [
			'dataProvider' => $dataProvider, 
			'articles' => $articles, 
			'mainArticle' => $mainArticle,
			'pagination' => $pagination,
		]);
    }
}