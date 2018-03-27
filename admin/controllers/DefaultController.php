<?php

namespace app\admin\controllers;

use app\admin\AdminController;
use app\models\Admin;
use app\models\General;
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
}
