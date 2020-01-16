<?php

use yii\db\Migration;

/**
 * Class m200114_134743_chart
 */
class m200114_134743_chart extends Migration
{
    /**
     * {@inheritdoc}
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $this->createTable('chart',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string(256)->notNull(),
            'type'=>$this->string(32)->notNull(),
            'file'=>$this->string(32),
            'active'=>$this->boolean(),
            'description'=>$this->text(),
            'options'=>$this->json(),
            'created_on'=>$this->timestamp()->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_on'=>$this->timestamp()->notNull()
                ->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->execute('');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('chart');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200114_134743_chart cannot be reverted.\n";

        return false;
    }
    */
}
