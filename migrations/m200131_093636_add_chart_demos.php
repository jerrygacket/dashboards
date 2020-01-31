<?php

use yii\db\Migration;

/**
 * Class m200131_093636_add_chart_demos
 */
class m200131_093636_add_chart_demos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('chart',[
            'title','type','file','active', 'page', 'options'],[
            ['test1','bar','bar.csv', '1', 'page1', ''],
            ['test2','doughnut','doughnut.csv', '1', 'page1', '{"circumference":3.14,"rotation":3.14}'],
            ['test3','line','bar.csv', '1', 'page1', '{"scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}}'],
            ['test4','horizontalBar','horizontalBar.csv', '1', 'page1', ''],
            ['test5','bar','bar.csv', '1', 'page2', ''],
            ['test6','doughnut','doughnut.csv', '1', 'page2', '{"circumference":3.14,"rotation":3.14}'],
            ['test7','line','bar.csv', '1', 'page2', '{"scales":{"yAxes":[{"ticks":{"beginAtZero":true}}]}}'],
            ['test8','horizontalBar','horizontalBar.csv', '1', 'page2', ''],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200131_093636_add_chart_demos cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200131_093636_add_chart_demos cannot be reverted.\n";

        return false;
    }
    */
}
