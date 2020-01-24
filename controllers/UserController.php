<?php


namespace app\controllers;


use app\base\BaseController;
use app\models\Users;
use yii\data\ActiveDataProvider;

class UserController extends BaseController
{
    public function actionIndex() {
        $this->rbac = $this->getRbac();
        if (!$this->rbac->canViewUsers()) {
            return $this->redirect('/site/forbidden');
        }
        $model = new Users();
        $model->load(\Yii::$app->request->queryParams);
        $query = $model::find();
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
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

    public function actionDelete() {

    }

    public function actionDeactivate() {

    }

    public function actionEdit() {

    }
}