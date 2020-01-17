<?php
/**
 * @var $model \app\models\Chart
 */
?>
<div class="">
    <div class="badge badge-primary"><?=$model->id?></div>
    <div class="chart-container">
        <canvas id="chart_<?=$model->id?>"></canvas>
    </div>
</div>

<script>
    let ctx<?=$model->id?> = document.getElementById('chart_<?=$model->id?>').getContext('2d');
    let Chart<?=$model->id?> = new Chart(ctx<?=$model->id?>, <?=json_encode($model->getChartData())?>);
</script>
