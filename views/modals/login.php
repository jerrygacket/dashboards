<?php

use yii\bootstrap4\Modal;

Modal::begin([
    'title' => '<h4 class="modal-title w-100 font-weight-bold">Вход</h4>',
    'headerOptions' => ['class' => 'modal-header text-center'],
    'footer' => '<button class="btn btn-success">Вход</button>',
    'footerOptions' => ['class' => 'modal-footer d-flex justify-content-center'],
    'bodyOptions' => ['id' => 'modal-login', 'class' => 'modal-body mx-3'],
    'toggleButton' => [
        'label' => 'Вход',
        'tag' => 'a',
        'type' => '',
        'class' => 'nav-link waves-effect waves-light',
    ],
]);

echo '
    <div class="md-form mb-5">
      <i class="fas fa-user prefix grey-text"></i>
      <input type="text" id="defaultForm-user" class="form-control validate">
      <label data-error="wrong" data-success="right" for="defaultForm-user">Логин</label>
    </div>

    <div class="md-form mb-4">
      <i class="fas fa-lock prefix grey-text"></i>
      <input type="password" id="defaultForm-pass" class="form-control validate">
      <label data-error="wrong" data-success="right" for="defaultForm-pass">Пароль</label>
    </div>
';

Modal::end();