<?php


namespace app\controllers;


use app\base\BaseController;
use app\components\AuthComponent;
use app\models\Users;
use yii\bootstrap4\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class UserController extends BaseController
{
    public function actionIndex() {
        $this->rbac = $this->getRbac();
        if (!$this->rbac->canViewUsers()) {
            return $this->redirect('/site/forbidden');
        }
        $model = new Users();
        $model->load(\Yii::$app->request->queryParams);
        $query = $model::find()->andWhere(['active' => '1']);
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
        $this->rbac = $this->getRbac();
        if (!$this->rbac->canCreateUser()) {
            return $this->redirect('/site/forbidden');
        }

        $model = Users::findOne([
                'id' => \Yii::$app->request->queryParams['id'] ?? ''
            ]) ?? new Users();
        if (\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post())) {
                if (\Yii::$app->request->isAjax) {
                    \Yii::$app->response->format=Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
                $model->active = 0;

                if ($model->save()) {
                    return $this->redirect('index');
                } else {
                    print_r($model->errors);
                    \Yii::$app->end(0);
                }
            }
        }

        return $this->redirect('index');
    }


    public function actionCreate() {
        $this->rbac = $this->getRbac();
        if (!$this->rbac->canCreateUser()) {
            return $this->redirect('/site/forbidden');
        }

        $model = new Users();
        if (\Yii::$app->request->isPost) {
            if ($model->load(\Yii::$app->request->post())) {
                if (\Yii::$app->request->isAjax) {
                    \Yii::$app->response->format=Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
                $component = \Yii::createObject(['class' => AuthComponent::class, 'nameClass' => Users::class]);
                if ($component->createUser($model)) {
                    $authManager = $this->rbac->getAuthManager();
                    $authManager->assign($authManager->getRole('user'),$model->id);
                    return $this->redirect('index');
                } else {
                    print_r($model->errors);
                    \Yii::$app->end(0);
                }
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate() {
        $this->rbac = $this->getRbac();
        if (!$this->rbac->canCreateUser()) {
            return $this->redirect('/site/forbidden');
        }
        $model = Users::findOne(['id' => \Yii::$app->request->queryParams['id'] ?? '']) ?? new Users();
        if (!$model->id) {
            return $this->redirect('create');
        }
        if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())) {
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            $component = \Yii::createObject(['class' => AuthComponent::class, 'nameClass' => Users::class]);
            if ($component->updateUser($model)) {
                return $this->redirect('index');
            } else {
                print_r($model->errors);
                \Yii::$app->end(0);
            }
        }


        return $this->render('update', ['model' => $model]);
    }
}