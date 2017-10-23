<?php
namespace app\modules\user\models\forms;

use app\modules\user\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class FormSignup extends Model
{
    public $username;
    public $email;
    public $password;
	
    public $verifyCode;
    private $_defaultRole;
	
	public $post;

    public function __construct($defaultRole, $config = [])
    {
        $this->_defaultRole = $defaultRole;
        parent::__construct($config);
    }
 
    public function rules()
    {
		$this->post = Yii::$app->request->post('FormSignup');
        return [
			[['username'], 'safe'],
			
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::className(), 'message' => 'This email address has already been taken.'],
 
            ['password', 'required'],
            ['password', 'string', 'min' => 5],
			
			[['username'], 'default', 'value' => $this->post['email']],
 
            ['verifyCode', 'captcha', 'captchaAction' => '/user/default/captcha'],
        ];
    }
	
	public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'FORM_LOGIN'),
            'password' => Yii::t('app', 'FORM_PW'),
			'email' => Yii::t('app', 'FORM_EMAIL'),
			'verifyCode' => Yii::t('app', 'FORM_VERIFY_CODE'),
        ];
    }
 
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->email; //$this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->status = User::STATUS_WAIT;
            $user->role = $this->_defaultRole;
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();
 
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
				
                $mailer->compose('@app/modules/user/mails/emailConfirm', ['user' => $user])
                    ->setFrom([$setFrom => Yii::$app->view->params['siteinfo']->title])
                    ->setTo($this->email)
                    ->setSubject('Подтверждение Email при регистрации на ' . Yii::$app->view->params['siteinfo']->title)
                    ->send();
            }
 
            return $user;
        }
 
        return null;
    }
}