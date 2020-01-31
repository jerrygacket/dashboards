<?php

use yii\db\Migration;

/**
 * Class m200131_083316_add_demo_users
 */
class m200131_083316_add_demo_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('users',[
            'username','active','password_hash'],[
            ['admin',true,\Yii::$app->security->generatePasswordHash('123456')],
            ['user',true,\Yii::$app->security->generatePasswordHash('123456')],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200131_083316_add_demo_users cannot be reverted.\n";

        return false;
    }
    */
}
