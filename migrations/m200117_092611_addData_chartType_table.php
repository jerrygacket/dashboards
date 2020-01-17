<?php

use yii\db\Migration;

/**
 * Class m200117_092611_addData_chartType_table
 */
class m200117_092611_addData_chartType_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('chartType',[
            'title','name'],[
            ['Круговая диаграмма','doughnut'],
            ['Линейная диаграмма','line'],
            ['Столбчатая диаграмма','bar'],
            ['Столбчатая горизонтальная диаграмма','horizontalBar'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('chartType');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200117_092611_addData_chartType_table cannot be reverted.\n";

        return false;
    }
    */
}
