<?php

/* @var $this \yii\web\View */
/* @var $charts \app\models\Chart[] */

//echo '<pre>';
//print_r($charts);
//echo '</pre>';
?>

<div class="row">
    <?php
        foreach ($charts as $model) {
            echo '<div class="col-md-6 col-12">';
            echo $this->render('/chart/_chart', ['model' => $model]).PHP_EOL;
            echo '</div>';
        }
    ?>
</div>

