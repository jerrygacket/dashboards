<?php

/* @var $this \yii\web\View */
/* @var $model mixed */
?>
<section class="mt-3">
    <div class="row">
        <div class="col-md-4 offset-md-4 col-12">
            <!-- Card -->
            <div class="card">
                <!-- Card body -->
                <div class="card-body">
                    <?= $this->render('/forms/register', ['model' => $model]); ?>
                </div>
            </div>
        </div>
    </div>
</section>
