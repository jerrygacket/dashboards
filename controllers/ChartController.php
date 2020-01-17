<?php


namespace app\controllers;


use app\base\BaseController;
use app\models\Chart;
use yii\bootstrap4\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use yii\web\UploadedFile;

class ChartController extends BaseController
{
    public function actionIndex () {
        $model = new Chart();
        $model->load(\Yii::$app->request->queryParams);
        $query = $model::find();
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5
            ],
            'sort' => [
                'defaultOrder' => [
                    'id'=>SORT_ASC
                ]
            ]
        ]);

        return $this->render('index', [
            'provider' => $provider,
        ]);
    }

    public function actionView () {
        $model = new Chart();

        return $this->render('view',['model'=> $model::findOne(['id' => \Yii::$app->request->queryParams['id'] ?? ''])]);
    }

    public function actionCreate () {
        $model = Chart::findOne([
            'id' => \Yii::$app->request->queryParams['id'] ?? ''
        ]) ?? new Chart();
        if (\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post())) {
                if (\Yii::$app->request->isAjax) {
                    \Yii::$app->response->format=Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
                $model->uploadedFile = UploadedFile::getInstance($model, 'uploadedFile');
                if ($model->uploadedFile) {
                    $model->file = uniqid().'.csv';
                }
                if ($model->save()) {
                    if ($model->uploadedFile) {
                        $model->upload();
                    }
                    return $this->render('view',['model'=>$model]);
                    //return \Yii::$app->runAction('/chart/view', ['id' => $model->id]);
                } else {
                    print_r($model->errors);
                    \Yii::$app->end(0);
                }
            }
        }

        return $this->render('create', ['model' => $model]);
    }
}