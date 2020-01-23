<?php

use yii\widgets\ActiveForm;

?>
<div class="row">
    <div class="col-md-4 offset-md-4 col-12">
        <!-- Card -->
        <div class="card">
            <!-- Card body -->
            <div class="card-body">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'method' => 'POST',
                    'action' => Yii::$app->homeUrl.'auth/register',
                    'fieldConfig' => [
                        'template' => "{input}\n{label}\n{hint}\n{error}",
                    ],
                    'options' => ['class' => 'class="text-center p-5"']
                ]);
                ?>
                <p class="h4 mb-4">Вход</p>
                <div class="md-form mb-5">
                    <i class="fas fa-user prefix grey-text"></i>
                    <?=$form->field($model, 'username', ['options' => ['tag' => false,]])
                        ->textInput(['required'=>true, 'class' => 'form-control validate ml-5', 'style' => 'color:#495057;'])
                        ->label('Логин'); ?>
                </div>

                <div class="md-form mb-4">
                    <i class="fas fa-lock prefix grey-text"></i>
                    <?=$form->field($model, 'password', ['options' => ['tag' => false,]])
                        ->passwordInput(['required'=>true, 'class' => 'form-control validate ml-5', 'style' => 'color:#495057;'])
                        ->label('Пароль'); ?>
                </div>

                <!-- Sign in button -->
                <div class="text-center">
                    <button class="btn btn-info my-4" type="submit">Вход</button>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>