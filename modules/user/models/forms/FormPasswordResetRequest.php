<?php
namespace app\modules\user\models\forms;

use app\modules\user\models\User;
use yii\base\Model;
use Yii;

/**
 * Password reset request form
 */
class FormPasswordResetRequest extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }
	
	public function attributeLabels()
    {
        return [
			'email' => Yii::t('app', 'FORM_EMAIL'),
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
			
				$mailer = Yii::$app->mailer;
				$setFrom = Yii::$app->view->params['siteinfo']->email;
				
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
				
                return $setFrom->compose('@app/modules/user/mails/passwordReset', ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user])
                    ->setFrom([$setFrom => Yii::$app->view->params['siteinfo']->title . ' robot'])
                    ->setTo($this->email)
                    ->setSubject('Восстановление пароля на' . Yii::$app->view->params['siteinfo']->title)
                    ->send();
            }
        }
        return false;
    }
}
