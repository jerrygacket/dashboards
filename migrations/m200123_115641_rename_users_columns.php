<?php

use yii\db\Migration;

/**
 * Class m200123_115641_rename_users_columns
 */
class m200123_115641_rename_users_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('users', 'login', 'username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('users', 'username', 'login');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200123_115641_rename_users_columns cannot be reverted.\n";

        return false;
    }
    */
}
