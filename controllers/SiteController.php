<?php

namespace app\controllers;

use app\common\CommonController;
use app\models\Admin;
use app\models\Carts;
use app\models\General;
use app\models\Telegram;
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

    public function actionAmdkandjkhuiwojlkndskbfjhuioijweonjkhbiuonaicslnkj()
    {
        $var = new \app\models\Telegram();

        unset($var);

        return 1;
    }

    public function actionSet()
    {
        $url = 'http://31.131.31.229/site/amdkandjkhuiwojlkndskbfjhuioijweonjkhbiuonaicslnkj';

        General::printR(General::curl_call('https://api.telegram.org/bot' . '595054108:AAEJjBZvh_XgzqNBFNM84jeCavOFr_2t8bY' . '/setWebhook?url=' . urlencode($url) . '&certificate=' . urlencode('http://31.131.31.229/cert.crt'), false));
    }
}
