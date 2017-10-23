<?php

namespace app\modules\review\controllers;

use app\controllers\FrontendController;
use app\modules\review\models\Review;
use app\modules\review\models\forms\FormReview;

use yii\data\ActiveDataProvider;

use yii\web\NotFoundHttpException;
use yii\web\BadRequestHttpException;
use yii\base\InvalidParamException;

use Yii;

/**
 * Default controller for the `review` module
 */
class DefaultController extends FrontendController
{
	/**
     * Renders the view for the module
     * @return string
     */
    public function actionView($id = '')
    {
		$review = Review::find()->where(['status' => 1, 'id' => $id])->one();
		
		if ($review) {
		
            $this->view->title = $review->title;
			
			/******************** SEO ************************/
			if($review->seo)
			{
				if (!empty($review->seo->meta_title))
				{
					$this->view->title = $review->seo->meta_title;
				}

				if (!empty($review->seo->meta_desc))
				{
					$this->view->params['meta_description'] = $review->seo->meta_desc;
				}

				if (!empty($review->seo->meta_key))
				{
					$this->view->params['meta_keywords'] = $review->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
			
			return $this->render('/one-review', ['review' => $review]);
			
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
		$query = Review::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => DEFAULT_FRONT_PAGE_SIZE
			],
        ]);
		
		$query->andFilterWhere(['status' => 1])
			->orderBy('weight');
			
			
		$reviews = $dataProvider->getModels();
		$pagination = $dataProvider->getPagination();
		
		if ($reviews) {
		
            $this->view->title = 'Отзывы';
			
			/******************** SEO ************************/
			if($reviews[0]->seo)
			{
				if (!empty($reviews[0]->seo->meta_title))
				{
					$this->view->title = $reviews[0]->seo->meta_title;
				}

				if (!empty($reviews[0]->seo->meta_desc))
				{
					$this->view->params['meta_description'] = $reviews[0]->seo->meta_desc;
				}

				if (!empty($reviews[0]->seo->meta_key))
				{
					$this->view->params['meta_keywords'] = $reviews[0]->seo->meta_key;
				}
			}
			/******************** /SEO ***********************/
			
			return $this->render('/review', ['reviews' => $reviews, 'pagination' => $pagination]);
			
        } else {
            throw new NotFoundHttpException('404 Страница не найдена.');
        }
    }
	
	/***************************** Отправка формы "Заказ товара" по AJAX **********************************/
	public function actionSendReviewForm()
    {
		$form = new FormReview();
		
		if ($form->load(Yii::$app->request->post()))
		{
			$post = Yii::$app->request->post('FormReview');
			
			$newModel = new Review();
				
			$newModel->title = $post['name'];
			$newModel->position = $post['position'];
			$newModel->status = 0;
			$newModel->teaser = $post['text'];
			$newModel->body = $post['text'];
			$newModel->weight = 0;
			$newModel->save();
		
			if ($form->sendEmail($this->siteinfo->email))
			{
				echo 'success';
			} 
			else 
			{
				echo 'error';
			}
		}
		else
		{
			echo 'error';
		}
    }
}
