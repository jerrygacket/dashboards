<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap4\Alert;
use yii\bootstrap4\Breadcrumbs;
use \yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/fontawesome.min.css" rel="stylesheet">
    <link href="/css/solid.min.css" rel="stylesheet">
    <link href="/css/mdb.min.css" rel="stylesheet">
    <link href="/css/chart.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/popper.min.js"></script>
<script src="/js/mdb.min.js"></script>
<script src="/js/chart.min.js"></script>

<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-dark teal',
        ],
    ]);
    $menuItems = [
        ['label' => 'Главная', 'url' => [Yii::$app->homeUrl]],
    ];
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = '<li class="nav-item">'.$this->render('/modals/login'). '</li>';
    } else {
        if (Yii::$app->user->identity->username == 'admin') {
            $menuItems[] = ['label' => 'Управление', 'url' => ['/site/settings']];
        }

        $chartPages = \app\models\ChartPage::find()->all();
//        $pageItems = [];
        foreach ($chartPages as $chartPage) {
//            $pageItems[] = ['label' => $chartPage->title, 'url' => ['/site/chart-page?id='.$chartPage->id]];
            $menuItems[] = ['label' => $chartPage->title, 'url' => ['/site/chart-page?id='.$chartPage->id]];
        }
//        $menuItems[] = ['label' => 'Страницы', 'items' => $pageItems];

        $menuItems[] = ['label' => 'Выход (' . Yii::$app->user->identity->username . ')', 'url' => ['//site/logout']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => $menuItems,
//        'items' => [
//
//            !Yii::$app->user->isGuest && Yii::$app->user->identity->username == 'admin' ? (
//            ['label' => 'Управление', 'url' => ['/site/settings']]
//            ) : (''),
//            Yii::$app->user->isGuest ? (
//                '<li class="nav-item">'.$this->render('/modals/login'). '</li>'
//            ) : (
//                '<li class="nav-item">'
//                . Html::a('Страница 1', '/site/chart-page?id=1', ['class' => 'nav-link waves-effect waves-light'])
//                . '</li>'.
//                '<li class="nav-item">'
//                . Html::a('Страница 2', '/site/chart-page?id=2', ['class' => 'nav-link waves-effect waves-light'])
//                . '</li>'.
//                '<li class="nav-item">'
//                . Html::a('Выход (' . Yii::$app->user->identity->username . ')', '/site/logout', ['class' => 'nav-link waves-effect waves-light'])
//                . '</li>'
//            ),
//
//        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget([
            'options' => [
                'class' => 'alert alert-warning alert-dismissible fade',
                'role' => 'alert'
            ]
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="page-footer font-small teal mt-4">
    <div class="footer-copyright text-center py-3">© <?= date('Y') ?> Copyright:
        <a href="/"> Dashboard Inc.</a>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
