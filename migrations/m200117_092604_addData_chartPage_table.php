<?php

use yii\db\Migration;

/**
 * Class m200117_092604_addData_chartPage_table
 */
class m200117_092604_addData_chartPage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('chartPage',[
            'title','name'],[
            ['Графики распродажа','page1'],
            ['Графики Поступление финансов/Склад','page2'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('chartPage');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200117_092604_addData_chartPage_table cannot be reverted.\n";

        return false;
    }
    */
}
