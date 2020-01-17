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
    echo $this->render('_chart', ['model' => $model]);
}
