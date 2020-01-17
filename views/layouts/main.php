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
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'items' => [
            ['label' => 'Главная', 'url' => [Yii::$app->homeUrl]],
            Yii::$app->user->isGuest ? (
                ''
            ) : (['label' => 'Управление', 'url' => ['/site/settings']]),
            Yii::$app->user->isGuest ? (
                '<li class="nav-item">'.$this->render('/modals/login'). '</li>'
            ) : (
                '<li class="nav-item">'
                . Html::a('Страница 1', '/site/page1', ['class' => 'nav-link waves-effect waves-light'])
                . '</li>'.
                '<li class="nav-item">'
                . Html::a('Страница 2', '/site/page2', ['class' => 'nav-link waves-effect waves-light'])
                . '</li>'.
                '<li class="nav-item">'
                . Html::a('Выход (' . Yii::$app->user->identity->username . ')', '/site/logout', ['class' => 'nav-link waves-effect waves-light'])
                . '</li>'
            ),

        ],
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

<footer class="page-footer font-small teal pt-4">
    <div class="container-fluid text-center text-md-left">
        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3">

                    <!-- Content -->
                    <h5 class="text-uppercase">Footer Content</h5>
                    <p>Here you can use rows and columns to organize your footer content.</p>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none pb-3">

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Link 1</a>
                        </li>
                        <li>
                            <a href="#!">Link 2</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Link 1</a>
                        </li>
                        <li>
                            <a href="#!">Link 2</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->
    </div>
    <div class="footer-copyright text-center py-3">© <?= date('Y') ?> Copyright:
        <a href="/"> My Company</a>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
