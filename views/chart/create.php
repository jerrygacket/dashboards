<?php



/* @var $this \yii\web\View */
/* @var $model \app\models\Chart */

?>
<div class="row">
    <div class="col-12">
        <?= $model->id ? '<h1>Редактировать график</h1>' : '<h1>Создать график</h1>' ?>

        <?= $this->render('_form',['model' => $model]); ?>

    </div>
</div>