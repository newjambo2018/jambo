<?php

namespace app\controllers;

use app\common\CommonController;
use app\models\Admin;
use app\models\Carts;
use app\models\General;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends CommonController
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    public function actionTest()
    {

        //        $catalog = simplexml_load_file(Yii::$app->basePath . '/common/Stock_Jambo.xml');
        //
        //        General::printR(((array)$catalog)['Товар']);
        //
        //        foreach ($catalog->Товар as $key => $value) {
        //            echo $key . "\n";
        //        }
    }


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCatalog()
    {
        return $this->render('catalog');
    }

    public function actionCheckout()
    {
        return $this->render('checkout');
    }

    public function actionProfile()
    {
        return $this->render('profile');
    }

    public function actionAuth()
    {
        return $this->render('auth');
    }

    public function actionRegister()
    {
        return $this->render('register');
    }

    public function actionError()
    {
        return $this->render('error');
    }

    public function actionAdminAuth()
    {
        $this->layout = false;

        if (Yii::$app->request->isPost) {
            $admin = Admin::find()
                ->where(['email' => General::post('email')])
                ->limit(1)
                ->one();

            if ($admin->password === Admin::cryptPass(General::post('password')) && $admin->active) {
                General::setSession('admin_auth', true);
                General::setSession('admin_info', $admin);

                return $this->redirect('/admin');
            }

        }

        return $this->render('admin-auth');
    }
}
