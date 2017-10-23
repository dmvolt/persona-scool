<?php

namespace app\modules\area\controllers;

use app\controllers\FrontendController;
use app\modules\area\models\Area;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;

use yii\data\ActiveDataProvider;

use Yii;

/**
 * Default controller for the `area` module
 */
class DefaultController extends FrontendController
{
	/**
     * Renders the view for the module
     * @return string
     */
    public function actionView($alias = '')
    {
		$area = Area::find()->where(['status' => 1, 'alias' => $alias])->one();
		$mainArea = Area::find()->where(['is_main' => 1])->one();
		
		$this->view->params['title_module'] = 'Участки';
		/******************** MAIN ************************/
		if($mainArea->seo) {
			if (!empty($mainArea->seo->title_h1)) {
				$this->view->params['title_module'] = $mainArea->seo->title_h1;
			}
		}
		/******************** /MAIN ***********************/
		
		if ($area) 
		{
            $this->view->title = $area->title;
			$this->view->params['title_h1'] = $area->title;
			/******************** SEO ************************/
			if($area->seo) {
				if (!empty($area->seo->meta_title)) {
					$this->view->title = $area->seo->meta_title;
				}
				
				if (!empty($area->seo->title_h1)) {
					$this->view->params['title_h1'] = $area->seo->title_h1;
				}

				if (!empty($area->seo->meta_desc)) {
					$this->view->params['meta_description'] = $area->seo->meta_desc;
				}

				if (!empty($area->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $area->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
			
			return $this->render('/area', ['area' => $area]);
			
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
		$query = Area::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => SIZE10
			],
        ]);
		
		$query->andFilterWhere(['is_main' => 0])
			->andFilterWhere(['status' => 1])
			->orderBy(['date' => SORT_DESC]);
			
			
		$areas = $dataProvider->getModels();
		$pagination = $dataProvider->getPagination();
		
		$mainArea = Area::find()->where(['is_main' => 1])->one();
		
		if ($mainArea) {
		
            $this->view->title = 'Участки';
			$this->view->params['title_h1'] = 'Участки';
			
			/******************** SEO ************************/
			if($mainArea && $mainArea->seo) {
				if (!empty($mainArea->seo->meta_title)) {
					$this->view->title = $mainArea->seo->meta_title;
				}
				if (!empty($mainArea->seo->title_h1)) {
					$this->view->params['title_h1'] = $mainArea->seo->title_h1;
				}
				if (!empty($mainArea->seo->meta_desc)) {
					$this->view->params['meta_description'] = $mainArea->seo->meta_desc;
				}
				if (!empty($mainArea->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $mainArea->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
        }
		
		return $this->render('/areas', [
			'dataProvider' => $dataProvider, 
			'areas' => $areas, 
			'mainArea' => $mainArea,
			'pagination' => $pagination,
		]);
    }
}