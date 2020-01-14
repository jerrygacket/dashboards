<?php

use yii\db\Migration;

/**
 * Class m200114_140838_create_rbac_tables
 */
class m200114_140838_create_rbac_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $componentRbac = Yii::createObject(array(
            'class' => \app\components\RbacComponent::class,
        ));
        $componentRbac->generateRbac();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $componentRbac = Yii::createObject(array(
            'class' => \app\components\RbacComponent::class,
        ));
        $componentRbac->cleanRbac();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200114_140838_create_rbac_tables cannot be reverted.\n";

        return false;
    }
    */
}
