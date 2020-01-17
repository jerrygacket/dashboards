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
        <?=$form->field($model,'active')->hiddenInput(['value' => '1'])->label(false);?>

        <?=$form->field($model,'title',['enableClientValidation'=>false,
            'enableAjaxValidation'=>true]);?>
        <?=$form->field($model,'page')->dropDownList(
            \yii\helpers\ArrayHelper::map(\app\models\ChartPage::find()->all(),'name','title'),
            [
                'prompt' => 'Выберите страницу...'
            ]
        );?>
        <?=$form->field($model,'description')->textarea(['row'=>'3']);?>
        <?=$form->field($model,'type')->dropDownList(
            \yii\helpers\ArrayHelper::map(\app\models\ChartType::find()->all(),'name','title'),
            [
                'prompt' => 'Выберите тип...'
            ]
        );?>
        <?=$form->field($model,'options')->textInput();?>


        <?php // выводим уже существующие рисунки если есть
        if (!empty($model->file)) {
            echo '<h3>Существующий файл</h3>';
            echo \yii\helpers\Html::a($model->file,'/files/'.$model->id.'/'.$model->file);
        } else {
            echo '<h3>Нет файлов</h3>';
        }
        ?>

        <?=$form->field($model,'uploadedFile')->fileInput()?>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Сохранить</button>
            <?= Html::a('Отмена',['/chart/index'], ['class' => 'btn btn-danger'])?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>