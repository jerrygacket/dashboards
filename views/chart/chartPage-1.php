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
        <?= $this->render('/chart/_chart', ['model' => $charts[1]]).PHP_EOL ?>
    </div>
    <div class="col-md-3 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[2]]).PHP_EOL ?>
    </div>
    <div class="col-md-3 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[3]]).PHP_EOL ?>
    </div>
    <div class="col-md-3 col-12">
        <div class="row">
            <div class="col-12">
                <?= $this->render('/chart/_chart-small', ['model' => $charts[4]]).PHP_EOL ?>
            </div>
            <div class="col-12">
                <?= $this->render('/chart/_chart-small', ['model' => $charts[24]]).PHP_EOL ?>
            </div>
            <div class="col-12">
                <?= $this->render('/chart/_chart-small', ['model' => $charts[25]]).PHP_EOL ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="row">
            <div class="col-md-6 col-12">
                <?= $this->render('/chart/_chart', ['model' => $charts[6]]).PHP_EOL ?>
            </div>
            <div class="col-md-6 col-12">
                <?= $this->render('/chart/_chart', ['model' => $charts[5]]).PHP_EOL ?>
            </div>
            <div class="col-md-6 col-12">
                <?= $this->render('/chart/_chart', ['model' => $charts[7]]).PHP_EOL ?>
            </div>
            <div class="col-md-6 col-12">
                <?= $this->render('/chart/_chart', ['model' => $charts[8]]).PHP_EOL ?>
            </div>
            <div class="col-md-6 col-12">
                <?= $this->render('/chart/_chart', ['model' => $charts[9]]).PHP_EOL ?>
            </div>
            <div class="col-md-6 col-12">
                <?= $this->render('/chart/_chart', ['model' => $charts[10]]).PHP_EOL ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <?= $this->render('/chart/_chart', ['model' => $charts[13]]).PHP_EOL ?>
        <div class="row">
            <div class="col-md-6 col-12">
                <?= $this->render('/chart/_chart', ['model' => $charts[11]]).PHP_EOL ?>
            </div>
            <div class="col-md-6 col-12">
                <?= $this->render('/chart/_chart', ['model' => $charts[12]]).PHP_EOL ?>
            </div>
        </div>
    </div>
    <?php
//        foreach ($charts as $model) {
//            echo '<div class="col-md-3 col-12">';
//            echo $this->render('/chart/_chart', ['model' => $model]).PHP_EOL;
//            echo '</div>';
//        }
    ?>
</div>

