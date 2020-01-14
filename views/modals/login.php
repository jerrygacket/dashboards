<?php

/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use app\models\LoginForm;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;

$model = new LoginForm();
$form = ActiveForm::begin([
    'id' => 'login-form',
    'action' => Yii::$app->homeUrl.'site/login',
    'fieldConfig' => [
        'template' => "{input}\n{label}\n{hint}\n{error}",
    ]
    ]);

Modal::begin([
    'title' => '<h4 class="modal-title w-100 font-weight-bold">Вход</h4>',
    'headerOptions' => ['class' => 'modal-header text-center'],
    'footer' => Html::submitButton('Вход', ['class' => 'btn btn-success', 'name' => 'login-button']),
    'footerOptions' => ['class' => 'modal-footer d-flex justify-content-center'],
    'bodyOptions' => ['id' => 'modal-login', 'class' => 'modal-body mx-3'],
    'toggleButton' => [
        'label' => 'Вход',
        'tag' => 'a',
        'type' => '',
        'class' => 'nav-link waves-effect waves-light',
    ],
]);
echo '<div class="md-form mb-5">
      <i class="fas fa-user prefix grey-text"></i>';
echo $form->field($model, 'username', ['options' => ['tag' => false,]])
    ->textInput(['required'=>true, 'class' => 'form-control validate ml-5', 'style' => 'color:#495057;'])
    ->label('Логин')
;
echo '</div>';

echo '<div class="md-form mb-4">
      <i class="fas fa-lock prefix grey-text"></i>';
echo $form->field($model, 'password', ['options' => ['tag' => false,]])
    ->passwordInput(['required'=>true, 'class' => 'form-control validate ml-5', 'style' => 'color:#495057;'])
    ->label('Пароль')
;
echo '</div>';

Modal::end();
ActiveForm::end();