<?php

/* @var $this yii\web\View */

$this->title = Yii::$app->name.' - Главная';
?>
<div class="site-index">

    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->username == 'admin') {?>

    <?php } else {?>

    <div class="body-content">

        <?=$this->render('/modals/login');?>

    </div>
    <?php } ?>

</div>
