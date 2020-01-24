<?php

use yii\db\Migration;

/**
 * Class m200124_123135_add_users_columns
 */
class m200124_123135_add_users_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users','title', 'string');
        $this->addColumn('users','description', 'text');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users','title');
        $this->dropColumn('users','description');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200124_123135_add_users_columns cannot be reverted.\n";

        return false;
    }
    */
}
