<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chart_pages}}`.
 */
class m200117_091746_create_chart_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chartPage',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(256)->notNull(),
            'name'=>$this->string(32)->notNull(),
        ]);
        $this->execute('');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chartPage');
    }
}
