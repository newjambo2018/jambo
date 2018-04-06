<?php

namespace app\admin\controllers;

use Yii;
use app\models\Client;
use app\admin\models\ClientsSearch;
use app\admin\AdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientsController implements the CRUD actions for Client model.
 */
class ClientsController extends AdminController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Client models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Client model.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Client model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     *
     * @return Client the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Client::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Client();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Client model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)
            ->delete();

        return $this->redirect(['index']);
    }

    public function actionAjaxWholesaleChange($client_id, $wholesale)
    {
        $model = $this->findModel($client_id);

        $model->wholesale = $wholesale;
        $model->wholesale_timecycle = 0;


        if ($model->save()) return json_encode([
            'text' => 'Успешно! ' . ((int)$model->wholesale === $model::WHOLESALE_ACTIVE ? '<br><b style="color: red;">НЕ ЗАБУДЬТЕ УКАЗАТЬ КРАЙНЮЮ ДАТУ ВРЕМЕННОГО ДОСТУПА</b>, либо не указывайте его вообще, для того, чтобы доступ был постоянный.' : ''),
            'type' => 'success'
        ]); else {
            Yii::error(print_r($model->errors, 1));

            return json_encode([
                'text' => 'Ошибка! Попробуйте обновить страницу и повторить ваши действия.',
                'type' => 'error'
            ]);
        }
    }

    public function actionAjaxWholesaleChangeTime($client_id, $time)
    {
        $model = $this->findModel($client_id);

        $model->wholesale_timecycle = $time ? strtotime($time) : 0;

        if ($model->save()) return json_encode([
            'text' => 'Успешно!',
            'type' => 'success'
        ]); else {
            Yii::error(print_r($model->errors, 1));

            return json_encode([
                'text' => 'Ошибка! Попробуйте обновить страницу и повторить ваши действия.',
                'type' => 'error'
            ]);
        }
    }
}
