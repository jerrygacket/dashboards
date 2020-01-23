<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property int $active
 * @property string $password_hash
 * @property string|null $token
 * @property string|null $auth_key
 * @property string $created_on
 * @property string $updated_on
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
            [['username', 'active', 'password_hash'], 'required'],
            [['active'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['username'], 'string', 'max' => 150],
            [['password_hash', 'token', 'auth_key'], 'string', 'max' => 300],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'active' => Yii::t('app', 'Active'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'token' => Yii::t('app', 'Token'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
        ];
    }
}
