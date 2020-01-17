<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\Chart */

if (!empty($model->id)) {
    echo '<h3>' . \yii\helpers\Html::encode($model->title) . '</h3>';
    echo \yii\widgets\DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title:html',
            'description:html',
            'type:html',
            'active:html',
            'options:html',
            'created_on:html',
            'updated_on:html',
//            [
//                'attribute' => 'created_on',
//                'format' =>  ['date', 'HH:mm:ss dd.MM.Y'],
//            ],
//            [
//                'attribute' => 'updated_on',
//                'format' =>  ['date', 'HH:mm:ss dd.MM.Y'],
//            ],
        ],
    ]);
    if (!empty($model->file)){
        echo \yii\helpers\Html::a($model->file,'/files/'.$model->id.'/'.$model->file);
    } else {
        echo '<p>Нет файлов</p>';
    }
    echo '<br>' . \yii\bootstrap\Html::a('Редактировать', ['/chart/create', 'id' => $model->id], ['class' => 'btn btn-primary']);
    echo '<br>' . \yii\helpers\Html::a('Все графики', '/chart/index', ['class' => 'btn btn-info']);
} ?>

<div class="">
    <div class="badge badge-primary"><?=$model->id?></div>
    <div class="chart-container">
        <canvas id="chart_<?=$model->id?>"></canvas>
    </div>
</div>

<script>
    var ctx = document.getElementById('chart_<?=$model->id?>').getContext('2d');
    var Chart<?=$model->id?> = new Chart(ctx, <?=json_encode($model->getChartData())?>);
</script>
