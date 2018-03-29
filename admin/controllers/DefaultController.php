<?php

namespace app\admin\controllers;

use app\admin\AdminController;
use app\models\Admin;
use app\models\AdminTelegramClients;
use app\models\General;
use app\models\Telegram;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AdminController
{
    /**
     * Renders the index view for the module
     *
     * @return string
     */

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
        General::destroySession('admin_auth');
        General::destroySession('admin_info');

        return $this->redirect('/');
    }

    public function actionSettings()
    {
        if (\Yii::$app->request->isPost) {
            if ($password = General::post('password')) {
                $admin = Admin::get();

                $admin->password = Admin::cryptPass($password);

                $admin->save();

                General::setFlash('success', 'Пароль успешно изменен!');
            }
        }

        return $this->render('settings');
    }

    public function actionIntegration()
    {
        if(\Yii::$app->request->isPost) {
            $admin = Admin::get(true);

            $telegram_member = AdminTelegramClients::find()
                ->where(['code_id' => General::post('code')])
                ->limit(1)
                ->one();

            if(!$telegram_member) {
                General::setFlash('errors', 'Ошибка! Синхронизационны код не найден. Попробуйте еще раз.');

                return $this->refresh();
            }

            $admin->telegram_id = $telegram_member->telegram_id;

            if($admin->save()) {
                General::setFlash('success', 'Успех! Ваш аккаунт привязан к Telegram!');
                $telegram = new Telegram();

                $telegram->sendMessage($admin->telegram_id, "<b>Поздравляем!</b>\n\nВаш Telegram теперь синхронизирован с учетной системой панели администратора Jambo. Теперь Вы будете получать различные уведомления от панели администратора в этом чате.");
            }
        }

        return $this->render('integration');
    }
}
