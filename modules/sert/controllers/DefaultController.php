<?php

namespace app\modules\sert\controllers;

use app\controllers\FrontendController;
use app\modules\sert\models\Sert;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;
use Yii;

/**
 * Default controller for the `sert` module
 */
class DefaultController extends FrontendController
{
	/**
     * Renders the view for the module
     * @return string
     */
    public function actionView($alias = '')
    {
		$sert = Sert::find()->where(['status' => 1, 'alias' => $alias])->one();
		
		if ($sert) 
		{
            $this->view->title = $sert->title;
			
			/******************** SEO ************************/
			if($sert->seo) {
				if (!empty($sert->seo->meta_title)) {
					$this->view->title = $sert->seo->meta_title;
				}

				if (!empty($sert->seo->meta_desc)) {
					$this->view->params['meta_description'] = $sert->seo->meta_desc;
				}

				if (!empty($sert->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $sert->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
			
			return $this->render('/sert', ['sert' => $sert]);
			
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
		$serts = Sert::find()->where(['status' => 1, 'is_main' => 0])->all();
		
		if ($serts) {
		
            $this->view->title = 'Сертификаты';
			$this->view->params['title_h1'] = 'Сертификаты';
			
			$mainSert = Sert::find()->where(['is_main' => 1])->one();
			
			/******************** SEO ************************/
			if($mainSert && $mainSert->seo) {
				if (!empty($mainSert->seo->meta_title)) {
					$this->view->title = $mainSert->seo->meta_title;
				}
				if (!empty($mainSert->seo->title_h1)) {
					$this->view->params['title_h1'] = $mainSert->seo->title_h1;
				}
				if (!empty($mainSert->seo->meta_desc)) {
					$this->view->params['meta_description'] = $mainSert->seo->meta_desc;
				}
				if (!empty($mainSert->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $mainSert->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
			
			return $this->render('/sertifications', ['serts' => $serts, 'mainSert' => $mainSert]);
			
        } else {
            throw new NotFoundHttpException('404 Страница не найдена.');
        }
    }
}