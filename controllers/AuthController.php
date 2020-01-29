<?php


namespace app\controllers;


use app\components\AuthComponent;
use app\models\LoginForm;
use app\models\Users;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class AuthController extends Controller
{

    /**
     * @var AuthComponent
     */
    public $component;

    public function init()
    {
        parent::init();

        $this->component = Yii::createObject([
            'class' => AuthComponent::class,
            'nameClass' => '\app\models\Users'
        ]);
    }

    public function actionLogin() {
        $model = $this->component->getModel();

        if (Yii::$app->request->isPost) {
            if(!$model->load(\Yii::$app->request->post())) {
//                print_r(\Yii::$app->request->post());
//                print_r($model);
//                Yii::$app->end(0);
            }

            if($this->component->authUser($model)){
                return $this->redirect(['/site/index']);
            }
        }

        return $this->render('login', ['model' => $model]);
    }

//    public function actionRegister() {
//        $model = $this->component->getModel();
//
//        if(\Yii::$app->request->isPost){
//            $model->load(\Yii::$app->request->post());
//            if($this->component->createUser($model)){
//                return $this->redirect(['/site/index']);
//            }
//        }
//
//        return $this->render('register', ['model' => $model]);
//    }



//    /**
//     * Login action.
//     *
//     * @return Response|string
//     */
//    public function actionLogin()
//    {
//        $model = $this->component->getModel();
//
//        if(\Yii::$app->request->isPost){
//            $model->load(\Yii::$app->request->post());
//            if($component->authUser($model)){
//                return $this->controller->redirect(['/day']);
//            }
//        }
//
//        return $this->controller->render('signin',['model'=>$model]);
//    }
//
//    /**
//     * Logout action.
//     *
//     * @return Response
//     */
//    public function actionLogout()
//    {
//        Yii::$app->user->logout();
//
//        return $this->goHome();
//    }
}