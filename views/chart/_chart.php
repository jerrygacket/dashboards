<?php
/**
 * @var $model \app\models\Chart
 */
$allModel = $model->getChartData();
$chartData = $allModel['data'];
//echo '<pre>';
//print_r($chartData);
//echo '</pre>';
//exit;
$initPos = 30;
?>
<div class="">
    <div class="chart-container">
        <div class="badge badge-primary"><?=$model->id?></div>

        <?php if ($chartData['type'] == 'doughnut') {
            echo '<div class="badge badge-light" style="top: '.$initPos.'%;bottom: auto;z-index: 100;">';
            foreach ($chartData['data']['datasets'] as $key => $dataSet) {
                echo '<div style="font-size:2.5vh">'.round($dataSet['data'][0]).'%</div>';
                echo '<div style="color:'.$dataSet['borderColor'][0].'">'.$chartData['data']['labels'][0].': '.$chartData['real'][0].'</div>';
                echo '<div style="color:'.$dataSet['borderColor'][1].'">'.$chartData['data']['labels'][1].': '.$chartData['real'][1].'</div>';
                $initPos += 4;
            }
            echo '</div>';
            $initPos += 20;
        } ?>

<!--        --><?php //if (!empty($chartData['comments'])) {
//            foreach ($chartData['comments'] as $comment) {
//                echo '<div class="badge badge-light" style="top: '.$initPos.'%;bottom: auto;z-index: 100;">';
//                echo $comment['label'].'<br>';
//                foreach ($comment['data'] as $key => $data) {
//                    echo '<div style="color:'.$comment['color'][$key].'">'.$chartData['data']['labels'][$key].': '.$data.'</div>';
//                }
//                echo '</div>';
//            $initPos += 20;
//            }
//        } ?>
        <canvas id="chart_<?=$model->id?>"></canvas>
    </div>
</div>

<script>
    let ctx<?=$model->id?> = document.getElementById('chart_<?=$model->id?>').getContext('2d');
    let Chart<?=$model->id?> = new Chart(ctx<?=$model->id?>,

        <?=$allModel['json']?>
    );
</script>
