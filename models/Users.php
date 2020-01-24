<?php

namespace app\models;

use yii\web\IdentityInterface;

class Users extends UsersBase implements IdentityInterface
{
    public $password;
    public $rememberMe = false;

    const SCENARIO_REGISTRATION = 'reg_scenario';
    const SCENARIO_AUTHORIZATION = 'auth_scenario';

    public function setRegistrationScenario(){
        $this->setScenario(self::SCENARIO_REGISTRATION);
        return $this;
    }

    public function setAuthorizationScenario(){
        $this->setScenario(self::SCENARIO_AUTHORIZATION);
        return $this;
    }

    public function getUsername(){
        return $this->username;
    }

    public function rules()
    {
        return array_merge([
            ['password','string','min'=>6, 'message' => 'Короткий пароль'],
            ['username','unique','on' => self::SCENARIO_REGISTRATION],
            ['username','exist','on' => self::SCENARIO_AUTHORIZATION],
        ], parent::rules()
        );
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return Users::find()->andWhere(['id'=>$id])->one();
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritDoc
     */
    public function setAuthKey($authKey)
    {
        $this->auth_key = $authKey;
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key == $authKey;
    }
}
