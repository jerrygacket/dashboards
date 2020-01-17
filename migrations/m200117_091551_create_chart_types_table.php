<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%chart_types}}`.
 */
class m200117_091551_create_chart_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('chartType',[
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
        $this->dropTable('chartType');
    }
}
