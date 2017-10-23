<?php
namespace app\modules\team\controllers;

use app\controllers\FrontendController;
use app\modules\team\models\Team;
use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;

use yii\data\ActiveDataProvider;

use Yii;
/**
 * Default controller for the `team` module
 */
class DefaultController extends FrontendController
{
	/**
     * Renders the view for the module
     * @return string
     */
    public function actionView($alias = '')
    {
		$team = Team::find()->where(['status' => 1, 'alias' => $alias])->one();
		$mainTeam = Team::find()->where(['is_main' => 1])->one();
		
		$this->view->params['title_module'] = 'Сотрудники';
		/******************** MAIN ************************/
		if($mainTeam->seo) {
			if (!empty($mainTeam->seo->title_h1)) {
				$this->view->params['title_module'] = $mainTeam->seo->title_h1;
			}
		}
		/******************** /MAIN ***********************/
		
		if ($team) {
		
            $this->view->title = $team->title;
			
			/******************** SEO ************************/
			if($team->seo)
			{
				if (!empty($team->seo->meta_title))
				{
					$this->view->title = $team->seo->meta_title;
				}
				if (!empty($team->seo->meta_desc))
				{
					$this->view->params['meta_description'] = $team->seo->meta_desc;
				}
				if (!empty($team->seo->meta_key))
				{
					$this->view->params['meta_keywords'] = $team->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
			
			return $this->render('/one-team', ['team' => $team]);
			
        } else {
            throw new NotFoundHttpException('404 Страница не найдена.');
        }
    }
	
    /**
     * Renders the index for the module
     * @return string
     */
    public function actionIndex()
    {
		$query = Team::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => 1000,
			],
        ]);
		
		$query->andFilterWhere(['is_main' => 0])
			->andFilterWhere(['status' => 1])
			->orderBy('weight');
			
		$teams = $dataProvider->getModels();
		//$pagination = $dataProvider->getPagination();
		
		$mainTeam = Team::find()->where(['is_main' => 1])->one();
		
		if ($teams) {
		
            $this->view->title = 'Сотрудники';
			$this->view->params['title_h1'] = 'Сотрудники';
			
			/******************** SEO ************************/
			if($mainTeam && $mainTeam->seo) {
				if (!empty($mainTeam->seo->meta_title)) {
					$this->view->title = $mainTeam->seo->meta_title;
				}
				if (!empty($mainTeam->seo->title_h1)) {
					$this->view->params['title_h1'] = $mainTeam->seo->title_h1;
				}
				if (!empty($mainTeam->seo->meta_desc)) {
					$this->view->params['meta_description'] = $mainTeam->seo->meta_desc;
				}
				if (!empty($mainTeam->seo->meta_key)) {
					$this->view->params['meta_keywords'] = $mainTeam->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
        }
		return $this->render('/team', ['dataProvider' => $dataProvider, 'teams' => $teams, 'mainTeam' => $mainTeam]);
    }
}