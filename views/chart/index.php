<?php
/**
 * @var $this \yii\web\View
 * @var $provider \yii\data\ActiveDataProvider
 *
 */

use yii\helpers\Html; ?>
<?= Html::a('Создать график', '/chart/create', ['class' => 'btn btn-primary']) ?>
<?=\yii\grid\GridView::widget([
    'dataProvider' => $provider,
    'columns' => [
        'title:html',
        'description:html',
        'type:html',
        'active:html',
        'options:html',
        'created_on:html',
        'updated_on:html',
        [
            'class' => '\yii\grid\ActionColumn',
            'header' => 'Действия',
            'template' => '{view} {create}',
            'controller' => 'chart',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('<i class="fas fa-eye"></i>', $url);
                },
                'create' => function ($url, $model, $key) {
                    return Html::a('<i class="fas fa-edit"></i>', $url);
                },
            ]

            // вы можете настроить дополнительные свойства здесь.
        ],
    ]
])
?>
<?= Html::a('Создать график', '/chart/create', ['class' => 'btn btn-primary']) ?>
