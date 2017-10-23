<?php

namespace app\modules\main\models\forms;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormRecall extends Model
{
    public $name;
    public $phone;
	public $time;
    //public $text;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'phone'], 'required', 'message' => 'Надо бы заполнить это поле'],
			[['name', 'phone', 'time'], 'string'],
			//[['text'], 'string'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'phone' => 'Номер телефона',
			'time' => 'Удобное для звонка время',
            //'text' => 'Комментарий',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function send($email)
    {
        if ($this->validate()) 
		{
			$mailer = Yii::$app->mailer;
			$setFrom = $email;
			
			if(isset(Yii::$app->view->params['setting']) && !empty(Yii::$app->view->params['setting']) && !empty(Yii::$app->view->params['setting']['smtp_host'])){
				$mailer->transport()
				->setClass('Swift_SmtpTransport')
				->setHost(Yii::$app->view->params['setting']['smtp_host'])
				->setUsername(Yii::$app->view->params['setting']['smtp_username'])
				->setPassword(Yii::$app->view->params['setting']['smtp_password'])
				->setPort(Yii::$app->view->params['setting']['smtp_port'])
				->setEncryption(Yii::$app->view->params['setting']['smtp_encryption']);
				$setFrom = Yii::$app->view->params['setting']['smtp_username'];
			}
			
            $mailer->compose()
                ->setTo($email)
                ->setFrom([$setFrom => Yii::$app->view->params['siteinfo']->title])
                ->setReplyTo([$setFrom => Yii::$app->view->params['siteinfo']->title])
                ->setSubject('Сообщение из формы "Заказать звонок"')
                ->setHtmlBody('Имя: '.$this->name.'<br>Номер телефона: '.$this->phone.'<br><br>Удобное для звонка время: '.$this->time)
                ->send();
            return true;
        } 
		else 
		{
            return false;
        }
    }
}
