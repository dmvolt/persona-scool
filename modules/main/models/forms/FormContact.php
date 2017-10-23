<?php

namespace app\modules\main\models\forms;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormContact extends Model
{
    public $name;
    public $contact;
    public $text;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'contact', 'text'], 'required', 'message' => 'Необходимо заполнить это поле.'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'contact' => 'Телефон или e-mail',
            'text' => 'Текст сообщения',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) 
		{
			$mailer = Yii::$app->mailer;
			$setFrom = $email;
			
			if(isset(Yii::$app->view->params['setting']) && !empty(Yii::$app->view->params['setting']) && isset(Yii::$app->view->params['setting']['smtp_host'])){
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
                ->setSubject('Сообщение из формы обратной связи')
                ->setHtmlBody($this->name.' пишет:<br>'.$this->text.'<br><br>Контактные данные: '.$this->contact)
                ->send();
            return true;
        } 
		else 
		{
            return false;
        }
    }
}
