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
    <!-- Font Awesome -->
<!--    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">-->
    <!-- Google Fonts -->
<!--    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">-->
    <!-- Bootstrap core CSS -->
<!--    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Material Design Bootstrap -->
    <link href="/css/all.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/solid.min.css" rel="stylesheet">
    <link href="/css/mdb.min.css" rel="stylesheet">
    <link href="/css/chart.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/mdb.min.js"></script>
    <script src="/js/chart.min.js"></script>
</head>
<body>


<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img class="logo-img" src="/img/logo.svg">',//Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-light',
        ],
    ]);
    $menuItems = [
        '<li class="nav-item">'
        .Html::a('<i class="fas fa-home"></i>', [Yii::$app->homeUrl], ['class' => 'nav-link waves-effect waves-light'])
        . '</li>'
    ];
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = '<li class="nav-item">'.$this->render('/modals/login'). '</li>';
        echo '';
    } else {
        if (Yii::$app->user->identity->username == 'admin') {
            $menuItems[] = '<li class="nav-item">'
                .Html::a('<i class="fas fa-cogs"></i>', ['/chart/index'], ['class' => 'nav-link waves-effect waves-light'])
                . '</li>';
            $menuItems[] = '<li class="nav-item">'
                .Html::a('<i class="fas fa-users"></i>', ['/user/index'], ['class' => 'nav-link waves-effect waves-light'])
                . '</li>';
//                ['label' => 'Управление', 'url' => ['/site/settings']];
        }

        $chartPages = \app\models\ChartPage::find()->all();
        $pageItems = [];
        foreach ($chartPages as $oneChartPage) {
            $pageItems[] = ['label' => $oneChartPage->title, 'url' => ['/chart/chart-page?id='.$oneChartPage->id], 'options' => ['class' => 'btn btn-primary']];
//            $menuItems[] = ['label' => $chartPage->title, 'url' => ['/site/chart-page?id='.$chartPage->id]];
        }
        $menuItems[] = ['label' => '<i class="fas fa-chart-line"></i>', 'items' => $pageItems, 'encode' => false];

        $menuItems[] = '<li class="nav-item">'
            .Html::a('('. Yii::$app->user->identity->username .')'.'<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['class' => 'nav-link waves-effect waves-light'])
            . '</li>';
//            ['label' => 'Выход (' . Yii::$app->user->identity->username . ')', 'url' => ['//site/logout']];
    }
    echo '<span class="navbar-brand d-none d-sm-block" style="margin: 0 auto;">'.($this->params['header'] ?? '').'</span>';
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

    <?= isset($this->params['mainPage']) && $this->params['mainPage'] ? '' : '<div class="container-fluid">' ?>
        <?= $content ?>
    <?= isset($this->params['mainPage']) && $this->params['mainPage'] ? '' : '</div>' ?>
</div>

<?php if (!isset($this->params['mainPage']) || !$this->params['mainPage']) { ?>
<footer class="page-footer font-small mt-4 dark-footer">
    <div class="footer-copyright text-center py-3">© <?= date('Y') ?> Copyright:
        <a href="/"> Dashboard Inc.</a>
    </div>
</footer>
<?php } ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
