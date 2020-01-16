<?php



/* @var $this \yii\web\View */
/* @var $model \app\models\Chart */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>
<div class="row">
    <div class="col-12">
        <?= $model->id ? '<h1>Редактровать график</h1>' : '<h1>Создать график</h1>' ?>

        <?php $form=ActiveForm::begin([
            'options' => [
                'action'=>'/chart/create','enctype' => 'multipart/form-data'
            ]
        ]);?>

        <?=$form->field($model,'id')->hiddenInput()->label(false);?>
        <?=$form->field($model,'active')->hiddenInput(['value' => '0'])->label(false);?>

        <?=$form->field($model,'title',['enableClientValidation'=>false,
            'enableAjaxValidation'=>true]);?>
        <?=$form->field($model,'description')->textarea(['row'=>'3']);?>
        <?=$form->field($model,'type')->textInput();?>
        <?=$form->field($model,'options')->textInput();?>


        <?php // выводим уже существующие рисунки если есть
        if (!empty($model->files)) {
            echo '<h3>Существующие файлы</h3>';
            foreach ($model->files as $file) {
                echo '/files/'.$file;
            }
        } else {
            echo '<h3>Нет файлов</h3>';
        }
        ?>

        <?=$form->field($model,'uploadedFile')->fileInput()?>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Сохранить</button>
        </div>
        <?php ActiveForm::end(); ?>

        <?= Html::a('Отмена',['/site/settings'], ['class' => 'btn btn-danger'])?>
    </div>
</div>