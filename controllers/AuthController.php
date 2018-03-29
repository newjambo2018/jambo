<?php

namespace app\controllers;

use app\common\CommonController;
use app\models\Client;
use app\models\ClientActivation;
use app\models\General;
use yii\web\HttpException;

class AuthController extends CommonController
{

    public function actionIndex()
    {
        if (\Yii::$app->request->isPost) {
            if (General::post('register')) {
                $is_set = Client::find()
                    ->where(['username' => General::post('username')])
                    ->orWhere(['email' => General::post('email')])
                    ->limit(1)
                    ->count();

                if ($is_set) {
                    General::setFlash('errors', 'Пользователь с таким юзернеймом или E-mail уже существует!');

                    return $this->redirect('/auth');
                }

                $new_client = new Client();

                $new_client->created_at = time();
                $new_client->first_name = General::post('name');
                $new_client->last_name = General::post('last_name');
                $new_client->email = General::post('email');
                $new_client->phone = General::post('phone');
                $new_client->username = General::post('username');
                $new_client->is_active = 0;
                $new_client->subscribed = 1;
                $new_client->salt = General::newToken();
                $new_client->password = md5($new_client->salt . ':' . md5(General::post('password')));
                $new_client->wholesale = General::post('wholesale') === 'on' ? 1 : 0;

                if ($new_client->save()) {
                    $client_activation = new ClientActivation();

                    $client_activation->client_id = $new_client->id;
                    $client_activation->code = General::newToken(32);

                    $client_activation->save();

                    \Yii::$app->mailer->compose('activation', ['u' => $new_client->id, 'code' => $client_activation->code])
                        ->setTo($new_client->email)
                        ->setSubject('Активация Вашего аккаунта')
                        ->send();

                    General::setFlash('success', 'Пользователь успешно зарегистрирован! Подтвердите свой e-mail для продолжения работы!');
                } else
                    General::setFlash('errors', 'Ошибка! Не удалось зарегистрировать пользователя. Проверьте правильность заполнения полей.');

                return $this->redirect('/auth');
            } else if (General::post('auth')) {
                $client = Client::find()
                    ->where([
                        'or',
                        ['email' => General::post('email')],
                        ['username' => General::post('email')]
                    ])
                    ->limit(1)
                    ->one();

                if (!$client) {
                    General::setFlash('errors', 'Пользователь с такими данными не найден.');

                    return $this->redirect('/auth');
                }

                if (!$client->is_active) {
                    General::setFlash('errors', 'Активируйте свою почту, используя ссылку в e-mail.');

                    return $this->redirect('/auth');
                }

                $password = md5($client->salt . ':' . md5(General::post('password')));

                if ($password !== $client->password) {
                    General::setFlash('errors', 'Пользователь с такими данными не найден.');

                    return $this->redirect('/auth');
                }

                General::setSession('auth', true);
                General::setSession('auth_info', $client);

                return $this->redirect('/profile');
            }
        }

        // TEST!
        return $this->render('index');
    }

    public function actionActivate($u, $c)
    {
        $client = Client::find()
            ->where(['id' => $u])
            ->limit(1)
            ->one();

        if (!$client || $client->is_active) throw new HttpException(400);

        $client_activation = ClientActivation::find()
            ->where(['client_id' => $client->id])
            ->andWhere(['code' => $c])
            ->limit(1)
            ->one();

        if ($client_activation) {
            $client->is_active = 1;

            $client_activation->delete();
            $client->save();

            General::setFlash('success', '<b>Успех!</b> Ваш аккаунт успешно активирован. Теперь Вы можете войти в кабинет!');
        } else General::setFlash('errors', '<b>Ошибка!</b> Недействительная ссылка.');

        return $this->redirect('/auth');

    }

    public function actionLogout()
    {
        General::destroySession('auth');
        General::destroySession('auth_info');

        return $this->redirect('/');
    }

}