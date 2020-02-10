<?php

use app\models\ChartPage;

$chartPages = ChartPage::find()->all();
?>
<div class="view" style="background-image: url('/img/background.jpg'); background-repeat: no-repeat; background-size: cover; height: 845px;">

    <!-- Mask & flexbox options-->
    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

        <!-- Content -->
        <div class="text-center white-text mx-5 wow fadeIn">
            <h1 class="mb-4">
                <strong>Dashboards</strong>
            </h1>

            <?php
            foreach ($chartPages as $chartPage) { ?>
                <a href="/chart/chart-page?id=<?= $chartPage->id ?>" class="btn btn-outline-white btn-lg waves-effect waves-light">
                    <?= $chartPage->title ?>
                    <i class="fas fa-graduation-cap ml-2"></i>
                </a>
            <?php } ?>
        </div>
        <!-- Content -->

    </div>
    <!-- Mask & flexbox options-->

</div>