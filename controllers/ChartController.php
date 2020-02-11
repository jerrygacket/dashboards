<?php


namespace app\controllers;


use app\base\BaseController;
use app\models\Chart;
use app\models\ChartPage;
use yii\bootstrap4\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use yii\web\UploadedFile;

class ChartController extends BaseController
{
    public function actionIndex () {
        $this->rbac = $this->getRbac();
        if (!$this->rbac->canCreateChat()) {
            return $this->redirect('/site/forbidden');
        }

        $model = new Chart();
        $model->load(\Yii::$app->request->queryParams);
        $query = $model::find()->andWhere(['active' => '1']);
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
        $this->rbac = $this->getRbac();
        if (!$this->rbac->canCreateChat()) {
            return $this->redirect('/site/forbidden');
        }

        $model = new Chart();

        return $this->render('view',['model'=> $model::findOne(['id' => \Yii::$app->request->queryParams['id'] ?? ''])]);
    }

    public function actionCreate () {
        $this->rbac = $this->getRbac();
        if (!$this->rbac->canCreateChat()) {
            return $this->redirect('/site/forbidden');
        }

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
                    $model->file = $model->id.'/'.uniqid().'.csv';
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

    public function actionDelete() {
        $this->rbac = $this->getRbac();
        if (!$this->rbac->canCreateChat()) {
            return $this->redirect('/site/forbidden');
        }

        $model = Chart::findOne(['id' => \Yii::$app->request->queryParams['id'] ?? '']);
        if ($model) {
            $model->active = 0;
            if ($model->save()) {
                return $this->redirect('index');
            } else {
                print_r($model->errors);
                \Yii::$app->end(0);
            }
        }

        return $this->redirect('index');
    }

    /**
     * Displays page1.
     *
     * @return string
     */
    public function actionChartPage()
    {
        $this->rbac = $this->getRbac();
        if (!$this->rbac->canViewChat()) {
            return $this->redirect('/site/forbidden');
        }

        $pageId = \Yii::$app->request->queryParams['id'] ?? '1';
        $chartPage = ChartPage::find()->where(['id' => $pageId])->one();
        $charts = Chart::find()->where(['page' => 'page'.$pageId])->andWhere(['active' => 1])->all();
        $result = [];
        foreach ($charts as $chart) {
            $result[$chart->id] = $chart;
        }

        return $this->render('chartPage-'.$pageId, ['charts' => $result, 'chartPage' => $chartPage]);
    }
}