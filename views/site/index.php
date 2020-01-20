<?php

/* @var $this yii\web\View */

$this->title = 'Главная - ' . Yii::$app->name;
?>
<div class="site-index">

    <?php if (!Yii::$app->user->isGuest) {
        //&& Yii::$app->user->identity->username == 'admin'
        $this->params['mainPage'] = true;
        echo $this->render('/site/_main');
    } else {?>

    <div class="body-content">

        <?=$this->render('/modals/login');?>

    </div>
    <?php } ?>

</div>
