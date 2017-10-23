<?php

namespace app\modules\search\controllers;

use app\controllers\FrontendController;

use app\modules\service\models\Service;
use app\modules\team\models\Team;
use app\modules\article\models\Article;
use app\modules\action\models\Action;
use app\modules\page\models\Page;
use app\modules\faq\models\Faq;
use app\modules\review\models\Review;

use yii\data\ActiveDataProvider;

use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;
use Yii;

/**
 * Default controller for the `search` module
 */
class DefaultController extends FrontendController
{
    /**
     * Renders the index for the module
     * @return string
     */
    public function actionIndex()
    {
		$search = [];
		
		$q = Yii::$app->request->get('q');
		
		if($q)
		{
			/** Service **/
			$serviceQuery = Service::find()
					->with('thumb')
					->where(['status' => 1]);
			
			$serviceDataProvider = new ActiveDataProvider([
				'query' => $serviceQuery,
				'pagination' => [
					'pageSize' => 1000
				],
			]);
			
			/** Team **/		
			$teamQuery = Team::find()
					->with('thumb')
					->where(['status' => 1]);
					
			$teamDataProvider = new ActiveDataProvider([
				'query' => $teamQuery,
				'pagination' => [
					'pageSize' => 1000
				],
			]);
			
			/** Article **/		
			$articleQuery = Article::find()
					->with('thumb')
					->where(['status' => 1]);
					
			$articleDataProvider = new ActiveDataProvider([
				'query' => $articleQuery,
				'pagination' => [
					'pageSize' => 1000
				],
			]);
			
			/** Action **/		
			$actionQuery = Action::find()
					->with('thumb')
					->where(['status' => 1]);
					
			$actionDataProvider = new ActiveDataProvider([
				'query' => $actionQuery,
				'pagination' => [
					'pageSize' => 1000
				],
			]);
			
			/** Page **/		
			$pageQuery = Page::find()
					->where(['status' => 1]);
					
			$pageDataProvider = new ActiveDataProvider([
				'query' => $pageQuery,
				'pagination' => [
					'pageSize' => 1000
				],
			]);
			
			/** Faq **/		
			$faqQuery = Faq::find()
					->where(['status' => 1]);
					
			$faqDataProvider = new ActiveDataProvider([
				'query' => $faqQuery,
				'pagination' => [
					'pageSize' => 1000
				],
			]);
			
			/** Review **/		
			$reviewQuery = Review::find()
					->where(['status' => 1]);
			
			$reviewDataProvider = new ActiveDataProvider([
				'query' => $reviewQuery,
				'pagination' => [
					'pageSize' => 1000
				],
			]);
			
			/********************** QUERIES ***********************/
		
			$serviceQuery->andFilterWhere(['like', 'title', $q]);
			$serviceQuery->orFilterWhere(['like', 'body', $q]);
			
			$teamQuery->andFilterWhere(['like', 'title', $q]);
			$teamQuery->orFilterWhere(['like', 'body', $q]);
			
			$articleQuery->andFilterWhere(['like', 'title', $q]);
			$articleQuery->orFilterWhere(['like', 'body', $q]);
			
			$actionQuery->andFilterWhere(['like', 'title', $q]);
			$actionQuery->orFilterWhere(['like', 'body', $q]);
			
			$pageQuery->andFilterWhere(['like', 'title', $q]);
			$pageQuery->orFilterWhere(['like', 'body', $q]);
			
			$faqQuery->andFilterWhere(['like', 'title', $q]);
			$faqQuery->orFilterWhere(['like', 'body', $q]);
			
			$reviewQuery->andFilterWhere(['like', 'title', $q]);
			$reviewQuery->orFilterWhere(['like', 'body', $q]);
		
			/*********************** GET MODELES *******************/
			$serviceSearch = $serviceDataProvider->getModels();
			if($serviceSearch)
			{
				$search['Услуги'] = [
					'module' => 'service',
					'link' => '/services/',
					'is_id' => 0,
					'is_date' => 0,
					'content' => $serviceSearch,
				];
			}
			
			$teamSearch = $teamDataProvider->getModels();
			if($teamSearch)
			{
				$search['Специалисты'] = [
					'module' => 'team',
					'link' => '/team/',
					'is_id' => 0,
					'is_date' => 0,
					'content' => $teamSearch,
				];
			}
			
			$articleSearch = $articleDataProvider->getModels();
			if($articleSearch)
			{
				$search['Новости'] = [
					'module' => 'article',
					'link' => '/news/',
					'is_id' => 0,
					'is_date' => 1,
					'content' => $articleSearch,
				];
			}
			
			$actionSearch = $actionDataProvider->getModels();
			if($actionSearch)
			{
				$search['Акции'] = [
					'module' => 'action',
					'link' => '/actions/',
					'is_id' => 0,
					'is_date' => 0,
					'content' => $actionSearch,
				];
			}
			
			$pageSearch = $pageDataProvider->getModels();
			if($pageSearch)
			{
				$search['Страницы'] = [
					'module' => 'page',
					'link' => '/',
					'is_id' => 0,
					'is_date' => 0,
					'content' => $pageSearch,
				];
			}
			
			$faqSearch = $faqDataProvider->getModels();
			if($faqSearch)
			{
				$search['Вопрос-ответ'] = [
					'module' => 'faq',
					'link' => '/faq/',
					'is_id' => 1,
					'is_date' => 1,
					'content' => $faqSearch,
				];
			}
			
			$reviewSearch = $reviewDataProvider->getModels();
			if($reviewSearch)
			{
				$search['Отзывы'] = [
					'module' => 'review',
					'link' => '/reviews/',
					'is_id' => 1,
					'is_date' => 1,
					'content' => $reviewSearch,
				];
			}
		}
		
		//$pagination = $dataProvider->getPagination();
		
        $this->view->title = 'Результаты поиска';
		return $this->render('/search', [
			'search' => $search,
		]);
    }
}