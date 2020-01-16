<?php

namespace app\models;

use Yii;

/**
 * This is the  extended model class for table "users".
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
class Users extends UsersBase
{

}
