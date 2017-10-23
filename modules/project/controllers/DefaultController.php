<?php

namespace app\modules\project\controllers;

use app\controllers\FrontendController;
use app\modules\project\models\Project;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;

use yii\data\ActiveDataProvider;

use Yii;

/**
 * Default controller for the `project` module
 */
class DefaultController extends FrontendController
{
	/**
     * Renders the view for the module
     * @return string
     */
    public function actionView($alias = '')
    {
		$project = Project::find()->where(['status' => 1, 'alias' => $alias])->one();
		$mainProject = Project::find()->where(['is_main' => 1])->one();
		
		$this->view->params['title_module'] = 'Объекты';
		/******************** MAIN ************************/
		if($mainProject->seo) {
			if (!empty($mainProject->seo->title_h1)) {
				$this->view->params['title_module'] = $mainProject->seo->title_h1;
			}
		}
		/******************** /MAIN ***********************/
		
		if ($project) 
		{
            $this->view->title = $project->title;
			$this->view->params['title_h1'] = $project->title;
			/******************** SEO ************************/
			if($project->seo) {
				if (!empty($project->seo->meta_title)) {
					$this->view->title = $project->seo->meta_title;
				}
				
				if (!empty($project->seo->title_h1)) {
					$this->view->params['title_h1'] = $project->seo->title_h1;
				}

				if (!empty($project->seo->meta_desc)) {
					$this->view->params['meta_description'] = $project->seo->meta_desc;
				}

				if (!empty($project->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $project->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
			
			return $this->render('/project', ['project' => $project]);
			
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
		$query = Project::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => SIZE10
			],
        ]);
		
		$query->andFilterWhere(['is_main' => 0])
			->andFilterWhere(['status' => 1])
			->orderBy(['date' => SORT_DESC]);
			
			
		$projects = $dataProvider->getModels();
		$pagination = $dataProvider->getPagination();
		
		$mainProject = Project::find()->where(['is_main' => 1])->one();
		
		if ($mainProject) {
		
            $this->view->title = 'Объекты';
			$this->view->params['title_h1'] = 'Объекты';
			
			/******************** SEO ************************/
			if($mainProject && $mainProject->seo) {
				if (!empty($mainProject->seo->meta_title)) {
					$this->view->title = $mainProject->seo->meta_title;
				}
				if (!empty($mainProject->seo->title_h1)) {
					$this->view->params['title_h1'] = $mainProject->seo->title_h1;
				}
				if (!empty($mainProject->seo->meta_desc)) {
					$this->view->params['meta_description'] = $mainProject->seo->meta_desc;
				}
				if (!empty($mainProject->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $mainProject->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
        }
		
		return $this->render('/projects', [
			'dataProvider' => $dataProvider, 
			'projects' => $projects, 
			'mainProject' => $mainProject,
			'pagination' => $pagination,
		]);
    }
}