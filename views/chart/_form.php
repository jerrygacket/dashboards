<?php

/* @var $model \app\models\Chart */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$form=ActiveForm::begin([
    'options' => [
        'action'=>'/chart/create','enctype' => 'multipart/form-data'
    ]
]);

echo $form->field($model,'id')->hiddenInput()->label(false);
echo $form->field($model,'active')->hiddenInput(['value' => '1'])->label(false);

echo $form->field($model,'title',['enableClientValidation'=>false,
    'enableAjaxValidation'=>true]);
echo $form->field($model,'page')->dropDownList(
    \yii\helpers\ArrayHelper::map(\app\models\ChartPage::find()->all(),'name','title'),
    [
        'prompt' => 'Выберите страницу...'
    ]
);
echo $form->field($model,'description')->textarea(['row'=>'3']);
echo $form->field($model,'type')->dropDownList(
    \yii\helpers\ArrayHelper::map(\app\models\ChartType::find()->all(),'name','title'),
    [
        'prompt' => 'Выберите тип...'
    ]
);
echo $form->field($model,'options')->textInput();

$files = array_diff(scandir(\Yii::getAlias('@webroot/'.$model::CHART_FILES_PATH)), array('..', '.'));
echo $form->field($model,'file')->dropDownList(
    array_combine($files, $files),
    [
        'prompt' => 'Выберите файл...'
    ]
);

// выводим уже существующие рисунки если есть
//if (!empty($model->file)) {
//    echo '<h3>Текущий файл</h3>';
//    echo \yii\helpers\Html::a($model->file,'/files/'.$model->id.'/'.$model->file);
//} else {
//    echo '<h3>Нет файлов</h3>';
//}


//echo $form->field($model,'uploadedFile')->fileInput()?>

<div class="form-group">
    <button class="btn btn-success" type="submit">Сохранить</button>
    <?= Html::a('Отмена',['/chart/index'], ['class' => 'btn btn-danger'])?>
</div>
<?php ActiveForm::end(); ?>
