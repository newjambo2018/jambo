<?php
/**
 * Created by PhpStorm.
 * User: johankitelman
 * Date: 06.03.18
 * Time: 13:04
 */

namespace app\controllers;


use app\common\AuthedController;
use app\common\CommonController;
use app\models\Client;
use app\models\General;

class ProfileController extends AuthedController
{

    public function actionIndex()
    {
        $client = General::getUser(1);

        if (\Yii::$app->request->isPost) {
            $client->first_name = General::post('name');
            $client->last_name = General::post('last_name');
            $client->phone = General::post('phone');
            if (General::post('password')) $client->password = md5($client->salt . ':' . md5(General::post('password')));

            if ($client->save()) {
                General::setFlash('success', 'Информация обновлена!');

                General::setSession('auth_info', $client);
            }
        }

        return $this->render('index', [
            'client' => $client
        ]);
    }


    public function actionHistory()
    {
        return $this->render('history');
    }

}