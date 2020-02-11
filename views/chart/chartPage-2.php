<?php

/* @var $this \yii\web\View */
/* @var $charts \app\models\Chart[] */

//echo '<pre>';
//print_r($charts);
//echo '</pre>';
if (!empty($chartPage)) {
    $this->title = $chartPage->title . ' - ' . Yii::$app->name;
    $this->params = array_merge($this->params,['header' => $chartPage->title]);
}
?>

<div class="row">
    <div class="col-md-3 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[14]]).PHP_EOL ?>
    </div>
    <div class="col-md-3 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[15]]).PHP_EOL ?>
    </div>
    <div class="col-md-6 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[16]]).PHP_EOL ?>
    </div>
    <div class="col-md-3 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[17]]).PHP_EOL ?>
    </div>
    <div class="col-md-3 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[18]]).PHP_EOL ?>
    </div>
    <div class="col-md-3 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[19]]).PHP_EOL ?>
    </div>
    <div class="col-md-3 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[20]]).PHP_EOL ?>
    </div>
    <div class="col-md-3 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[21]]).PHP_EOL ?>
    </div>
    <div class="col-md-3 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[22]]).PHP_EOL ?>
    </div>
    <div class="col-md-3 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[23]]).PHP_EOL ?>
    </div>

    <?php
//        foreach ($charts as $model) {
//            echo '<div class="col-md-3 col-12">';
//            echo $this->render('/chart/_chart', ['model' => $model]).PHP_EOL;
//            echo '</div>';
//        }
    ?>
</div>

