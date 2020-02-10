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
    <?php
        foreach ($charts as $model) {
            echo '<div class="col-md-3 col-12">';
            echo $this->render('/chart/_chart', ['model' => $model]).PHP_EOL;
            echo '</div>';
        }
    ?>
</div>

