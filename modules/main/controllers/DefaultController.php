<?php

namespace app\modules\main\controllers;

use Yii;
use app\controllers\FrontendController;
use app\modules\main\models\forms\FormContact;
use app\modules\main\models\forms\FormRecall;

/**
 * Default controller for the `main` module
 */
class DefaultController extends FrontendController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('/index');
    }
	
	/***************************** Переадресация внешних ссылок **********************************/
	public function actionGo()
    {
		if($ref = Yii::$app->request->get('ref'))
		{
			return $this->redirect('http://'.$ref, 301)->send();
		}
    }
	
	/***************************** Отправка формы "Обратная связь" по AJAX **********************************/
	public function actionSendContactForm()
    {
		$form = new FormContact();
        if ($form->load(Yii::$app->request->post()) AND $form->contact($this->siteinfo->email)) 
		{
            echo 'success';
        } else {
			echo 'error';
		}
    }
	
	/***************************** Отправка формы "Обратный звонок" по AJAX **********************************/
	public function actionSendRecallForm()
    {
		$form = new FormRecall();
        if ($form->load(Yii::$app->request->post()) AND $form->send($this->siteinfo->email))
		{
            echo 'success';
        } else {
			echo 'error';
		}
    }
}