<?php

namespace app\modules\service\controllers\backend;
use Yii;

/********** USE MODELS *********/
use app\modules\service\models\Service;
use app\modules\service\models\ServiceSearch;
use app\modules\file\models\File;
use app\modules\seo\models\Seo;
use app\controllers\BackendController;
use yii\web\NotFoundHttpException;
use app\modules\service\Module;
use yii\helpers\Url;

/**
 * ServiceController implements the CRUD actions for Service model.
 */
class DefaultController extends BackendController
{
    /**
     * Lists all Service models.
     * @return mixed
     */
    public function actionIndex()
    {
        $newModel = new Service();
		$searchModel = new ServiceSearch();
		
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('/backend/index', [
			'newModel' => $newModel,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'selectItems' => $this->findItems(),
        ]);
    }
	
    /**
     * Displays a single Service model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('/backend/view', [
            'model' => $this->findModel($id),
        ]);
    }
	
    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' service.
     * @return mixed
     */
    public function actionCreateFast()
    {
        $model = new Service();
        $model->status = 1; // Значение поля по умолчанию
        $model->weight = 0; // Значение поля по умолчанию
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['index']);
        }
        else
        {
            return $this->render('/backend/create', [
                'model' => $model,
				'selectItems' => $this->findItems()
            ]);
        }
    }
	
    /**
     * Creates a new Service model.
     * If creation is successful, the browser will be redirected to the 'view' service.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Service();
		$model->status = 1; // Значение поля по умолчанию
		$model->weight = 0; // Значение поля по умолчанию
        if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			$this->post = Yii::$app->request->post();
            /*** Редактирование (добавление) картинки 1 миниатюры ***/
            $fileModel = new File();
            $fileModel->updateThumb($this->post, $model, $model->id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);
			
			/*** Редактирование (добавление) картинки 2 миниатюры ***/
            $fileModel = new File();
            $fileModel->updateThumb2($this->post, $model, $model->id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);
			
            /*** Редактирование SEO ***/
            $seoModel = new Seo();
            $seoModel->updateSeo($this->post, $model->id, Module::getInstance()->id);
            return $this->redirect(['index']);
        } 
		else 
		{
            return $this->render('/backend/create', [
                'model' => $model,
				'selectItems' => $this->findItems(),
            ]);
        }
    }
	
    /**
     * Fast Update in Popup window
     */
    public function actionUpdateFast($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $this->post = Yii::$app->request->post();
            /*** Редактирование (добавление) картинки 1 миниатюры ***/
            $fileModel = new File();
            $fileModel->updateThumb($this->post, $model, $model->id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);
			
			/*** Редактирование (добавление) картинки 2 миниатюры ***/
            $fileModel = new File();
            $fileModel->updateThumb2($this->post, $model, $model->id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);
			
            return $this->redirect([$this->post['popup_edit_redirect']]); // Возвращаемся на предыдущую страницу
        }
        else
        {
            return $this->renderAjax('/backend/update-fast', [
                'model' => $model,
				'selectItems' => $this->findItems()
            ]);
        }
    }
	
    /**
     * Updates an existing Service model.
     * If update is successful, the browser will be redirected to the 'view' service.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			$this->post = Yii::$app->request->post();
            /*** Редактирование (добавление) картинки 1 миниатюры ***/
            $fileModel = new File();
            $fileModel->updateThumb($this->post, $model, $model->id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);
			
			/*** Редактирование (добавление) картинки 2 миниатюры ***/
            $fileModel = new File();
            $fileModel->updateThumb2($this->post, $model, $model->id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);
			
            /*** Редактирование SEO ***/
            $seoModel = new Seo();
            $seoModel->updateSeo($this->post, $model->id, Module::getInstance()->id);
            return $this->redirect(['index']);
        } 
		else 
		{
            return $this->render('/backend/update', [
                'model' => $model,
				'selectItems' => $this->findItems(),
            ]);
        }
    }
	
    /**
     * Deletes an existing Service model.
     * If deletion is successful, the browser will be redirected to the 'index' service.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		/*** Ищем вложенные материалы и переопределяем в корневые ***/
		Service::updateAll(['parent_id' => 0], 'parent_id = '.$id);
        $model = $this->findModel($id);
		
		/*** Удаляем записи из связанной таблицы service_service ***/
		if($model->parent)
		{
			foreach($model->parent as $obj)
			{
				$model->unlink('parent', $obj, true);
			}
		}
		
		/*** Удаляем сам материал ***/
		$model->delete();
		/*** Удаляем файлы и записи из таблицы file ***/
		$fileModel = new File();
		$fileModel->deleteFiles($id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);
		/*** Удаляем записи из таблицы seo ***/
		$seoModel = new Seo();
		$seoModel->deleteSeo($id, Module::getInstance()->id);
        return $this->redirect(['index']);
    }
	
    /**
     * MULTIDELETE Массовое удаление материалов
     * MULTIUPDATE Массовое редактирование материалов
     */
    public function actionMultiAction()
    {
        if($arrKey = Yii::$app->request->post('selection'))
        {
            if($arrKey AND is_array($arrKey) AND count($arrKey)>0)
            {
                $fileModel = new File();
                $seoModel = new Seo();
                foreach($arrKey as $id)
                {
                    /*** Ищем вложенные материалы и переопределяем в корневые ***/
                    Service::updateAll(['parent_id' => 0], 'parent_id = '.$id);
                    $model = $this->findModel($id);
					
					/*** Удаляем записи из связанной таблицы service_service ***/
					if($model->parent)
					{
						foreach($model->parent as $obj)
						{
							$model->unlink('parent', $obj, true);
						}
					}
                    
                    /*** Удаляем сам материал ***/
                    $model->delete();
                    /*** Удаляем файлы и записи из таблицы file ***/
                    $fileModel->deleteFiles($id, Module::getInstance()->id, Module::getInstance()->imagesDirectory);
                    /*** Удаляем записи из таблицы seo ***/
                    $seoModel->deleteSeo($id, Module::getInstance()->id);
                }
            }
        }
        if($multiedit = Yii::$app->request->post('multiedit'))
        {
            if($multiedit AND is_array($multiedit) AND count($multiedit)>0)
            {
                foreach($multiedit as $id => $field)
                {
                    if($model = $this->findModelForMultiAction($id))
                    {
                        foreach($field as $key => $value)
                        {
                            if(isset($field[$key]))
                            {
                                $model->{$key} = $value;
                            }
                        }
                        $model->save();
                    }
                }
            }
        }
        return $this->redirect(['index']);
    }
	
    protected function findModelForMultiAction($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            return false;
        }
    }
	
    /**
     * Finds the Service model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Service the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Service::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested service does not exist.');
        }
    }
	
	protected function findItems()
    {
		return Service::find()->orderBy('weight')->all();
    }
}