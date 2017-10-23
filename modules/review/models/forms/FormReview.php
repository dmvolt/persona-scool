<?php

namespace app\modules\review\models\forms;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FormReview extends Model
{
    public $name;
    public $position;
    public $text;
	public $sitename;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'position', 'text'], 'required', 'message' => 'Необходимо заполнить это поле.'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'ФИО',
            'position' => 'Должность',
            'text' => 'Отзыв',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function sendEmail($email)
    {
        if ($this->validate()) 
		{
			$mailer = Yii::$app->mailer;
			$setFrom = Yii::$app->view->params['siteinfo']->email;
			
			if(isset(Yii::$app->view->params['setting']) && !empty(Yii::$app->view->params['setting']) && isset(Yii::$app->view->params['setting']['smtp_host']) && !empty(Yii::$app->view->params['setting']['smtp_host'])){
				$transport = [
					'class' => 'Swift_SmtpTransport',
					'host' => Yii::$app->view->params['setting']['smtp_host'],
					'username' => Yii::$app->view->params['setting']['smtp_username'],
					'password' => Yii::$app->view->params['setting']['smtp_password'],
					'port' => Yii::$app->view->params['setting']['smtp_port'],
					'encryption' => Yii::$app->view->params['setting']['smtp_encryption'],
				];
				
				$mailer->setTransport($transport);
				$setFrom = Yii::$app->view->params['setting']['smtp_username'];
			}
			
			// Шаблон
			$emailTemp = \app\modules\emailtemp\components\BlockEmailtemp::_(9);
			
			$this->sitename = Yii::$app->view->params['siteinfo']->title;
			
			if($emailTemp)
			{
				foreach(\app\modules\emailtemp\models\Emailtemp::getVarsArray() as $var => $d)
				{
					$emailTemp->subject = str_replace('['.$var.']', (isset($this->{$var}))?$this->{$var}:'', $emailTemp->subject);
					$emailTemp->body = str_replace('['.$var.']', (isset($this->{$var}))?$this->{$var}:'', $emailTemp->body);
				}
				
				$mailer->compose()
				->setTo($email)
				->setFrom([$setFrom => $this->sitename])
				->setReplyTo([$setFrom => $this->sitename])
				->setSubject($emailTemp->subject)
				->setHtmlBody($emailTemp->body)
				->send();
			}
			else
			{
				$mailer->compose()
				->setTo($email)
				->setFrom([$setFrom => $this->sitename])
				->setReplyTo([$setFrom => $this->sitename])
				->setSubject('Новый отзыв на сайте')
				->setHtmlBody($this->name.' пишет:<br>'.$this->text)
				->send();
			}
            return true;
        } 
		else 
		{
            return false;
        }
    }
}
