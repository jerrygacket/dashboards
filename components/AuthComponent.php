<?php


namespace app\components;


use app\models\Users;
use yii\base\Component;

/**
 *
 * @property mixed $model
 */
class AuthComponent extends Component
{
    public $nameClass;

    public function getModel() {
        return new $this->nameClass;
    }

    /**
     * @param $model Users
     * @return bool
     */
    public function authUser(&$model):bool{
        $model->setAuthorizationScenario();
        if(!$model->validate(['username','password'])){
            $model->addError('username','Неверный пользователь или пароль');
            $model->addError('password','Неверный пользователь или пароль');
            return false;
        }
        $user = $this->getUserFromLogin($model->username);
        if(empty($user) || !$this->checkPassword($model->password,$user->password_hash)) {
            $model->addError('username','Неверный пользователь или пароль');
            $model->addError('password','Неверный пользователь или пароль');
        }
        $model->addError('password',print_r($model,true));

        return \Yii::$app->user->login($user,$model->rememberMe ? 0 : 3600);
    }

    private function checkPassword($password,$password_hash){
        return \Yii::$app->security->validatePassword($password,$password_hash);
    }

    /**
     * @param $username
     * @return Users|array|\yii\db\ActiveRecord|null
     */
    private function getUserFromLogin($username){
        return Users::find()->andWhere(['username'=>$username])->one();
    }

    /**
     * @param $model Users
     * @return bool
     */
    public function createUser(&$model):bool{
        $model->setRegistrationScenario();
        $model->password_hash=$this->hashPassword($model->password);
        $model->auth_key=$this->generateAuthKey();
        $model->active = 1;
        if($model->save()){
            return true;
        }

        return false;
    }

    private function generateAuthKey(){
        return \Yii::$app->security->generateRandomString();
    }

    private function hashPassword($password){
        return \Yii::$app->security->generatePasswordHash($password);
    }
}