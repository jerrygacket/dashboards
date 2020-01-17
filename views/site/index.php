<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name.' - Главная';
?>
<div class="site-index">

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->username == 'admin') {?>
    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead"></p>

        <p><a class="btn btn-lg btn-success" href="/site/settings">Настройки</a></p>
    </div>
    <?php } ?>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Графики</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="/">Больше графиков &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Графики</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-danger" href="/">Больше графиков &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Графики</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-primary" href="/">Больше графиков &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
