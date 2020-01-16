<?php

namespace app\models;

use Yii;

/**
 * This is the Autogenerated by gii model class for table "users".
 *
 * @property int $id
 * @property string $password_hash
 * @property string|null $token
 * @property string|null $auth_key
 * @property string $created_on
 * @property string $updated_on
 * @property string $login
 * @property int $active
 */
class UsersBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password_hash', 'login', 'active'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['active'], 'integer'],
            [['password_hash', 'token', 'auth_key'], 'string', 'max' => 300],
            [['login'], 'string', 'max' => 150],
            [['login'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'token' => Yii::t('app', 'Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'login' => Yii::t('app', 'Login'),
            'active' => Yii::t('app', 'Active'),
        ];
    }
}
