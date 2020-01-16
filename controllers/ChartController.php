<?php


namespace app\controllers;


use app\base\BaseController;
use app\models\Chart;
use app\models\Files;
use yii\bootstrap4\ActiveForm;
use yii\helpers\FileHelper;
use yii\web\Response;
use yii\web\UploadedFile;

class ChartController extends BaseController
{
    public function actionIndex () {
        $model = new Chart();

        return $this->render('index', ['charts' => $model::find()->all()]);
    }

    public function actionView () {

    }

    public function actionCreate () {
        $model = new Chart();
        if (\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post())) {
                if (\Yii::$app->request->isAjax) {
                    \Yii::$app->response->format=Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
                if ($model->save()) {
                    $model->uploadedFile = UploadedFile::getInstance($model, 'uploadedFile');
                    if(!empty($model->uploadedFile)) {
                        FileHelper::createDirectory(\Yii::getAlias('@webroot/files'));
                        $path=\Yii::getAlias('@webroot/files/'.uniqid().'.csv');
                        if(!$model->uploadedFile->saveAs($path)){
                            $model->addError('file','Не удалось сохранить файл');
                        }else{
                            $newFile = new Files();
                            $newFile->chart_id = $model->id;
                            $newFile->filename = basename($path);
                            if ($newFile->save()) {
                                $model->file_id = $newFile->id;
                                $model->save();
                            }
                            print_r($newFile->errors);
                            \Yii::$app->end(0);
                        }

                    }
                    return $this->render('view',['model'=>$model]);
                } else {
                    print_r($model->errors);
                    \Yii::$app->end(0);
                }
            }

        }
        return $this->render('create', ['model' => $model]);
    }
}