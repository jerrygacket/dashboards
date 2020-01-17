<?php

use yii\db\Migration;

/**
 * Class m200117_085837_extend_chart_table
 */
class m200117_085837_extend_chart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('chart','page', 'string');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('chart','page');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200117_085837_extend_chart_table cannot be reverted.\n";

        return false;
    }
    */
}
