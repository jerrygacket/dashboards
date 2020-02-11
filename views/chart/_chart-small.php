<?php
/**
 * @var $model \app\models\Chart
 */
$chartData = $model->getChartData();
//echo '<pre>';
//print_r($chartData);
//echo '</pre>';
//exit;
$initPos = 50;
?>
<div class="row">
    <div class="col-6 chart-container">
        <div class="badge badge-primary"><?=$model->id?></div>
        <canvas id="chart_<?=$model->id?>"></canvas>
    </div>
    <div class="col-6">


        <?php if ($chartData['type'] == 'doughnut') {
            echo '<div class="badge badge-light" style="top: '.$initPos.'%;bottom: auto;z-index: 100;">';
            foreach ($chartData['data']['datasets'] as $key => $dataSet) {
                echo '<div style="color:'.$dataSet['borderColor'][0].'">'.$chartData['data']['labels'][0].': '.$chartData['real'][0].' / '.round($dataSet['data'][0]).'%</div>';
                echo '<div style="color:'.$dataSet['borderColor'][1].'">'.$chartData['data']['labels'][1].': '.$chartData['real'][1].'</div>';
            }
            echo '</div>';
            $chartData['options']['legend']['position'] = 'right';
        } ?>

    </div>
</div>

<script>
    let ctx<?=$model->id?> = document.getElementById('chart_<?=$model->id?>').getContext('2d');
    let Chart<?=$model->id?> = new Chart(ctx<?=$model->id?>,
        <?=json_encode($chartData)?>
    );
</script>
