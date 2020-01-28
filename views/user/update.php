<?php



/* @var $this \yii\web\View */
/* @var $model \app\models\Users|null */
?>

<section class="mt-3">
    <div class="row">
        <div class="col-md-4 offset-md-4 col-12">
            <!-- Card -->
            <div class="card">
                <!-- Card body -->
                <div class="card-body">
                    <h4 class="card-title">Редактировать пользователя <?=$model->username?></h4>
                    <?= $this->render('_form-edit',['model' => $model]); ?>
                </div>
            </div>
        </div>
    </div>
</section>
