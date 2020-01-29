<?php

namespace app\models;

use yii\web\IdentityInterface;

class Users extends UsersBase implements IdentityInterface
{
    public $password;
    public $newPassword = '';
    public $rememberMe = false;

    const SCENARIO_REGISTRATION = 'reg_scenario';
    const SCENARIO_AUTHORIZATION = 'auth_scenario';
    const SCENARIO_UPDATE = 'upd_scenario';

    public function setRegistrationScenario(){
        $this->setScenario(self::SCENARIO_REGISTRATION);
        return $this;
    }

    public function setAuthorizationScenario(){
        $this->setScenario(self::SCENARIO_AUTHORIZATION);
        return $this;
    }

    public function setUpdateScenario(){
        $this->setScenario(self::SCENARIO_UPDATE);
        return $this;
    }

    public function getUsername(){
        return $this->username;
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['password','string','min'=>6, 'message' => 'Короткий пароль'],
            //['newPassword','string','min'=>6,'on' => self::SCENARIO_UPDATE, 'message' => 'Короткий пароль'],
            ['username','unique','on' => self::SCENARIO_REGISTRATION, 'message' => 'Такой пользователь уже есть'],
            ['username','exist','on' => self::SCENARIO_AUTHORIZATION],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'username' => 'Логин',
            'password' => 'Пароль',
            'newPassword' => 'Новый пароль',
//            'password' => \Yii::t('app', 'Password'),
            'active' => 'Действующий пользователь',
        ];
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
