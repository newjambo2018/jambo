<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\admin\models\ClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;

$managers = \yii\helpers\ArrayHelper::map(\app\models\Admin::find()
    ->all(), 'id', 'name');

?>
<div class="client-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            //            'password',
            //            'salt',
            [
                'attribute' => 'name',
                'format'    => 'raw',
                'label'     => 'Имя',
                'value'     => function ($data) {
                    return $data->first_name . ' ' . $data->last_name;
                }
            ],
            //            'last_name',
            [
                'attribute' => 'personal_manager',
                'format'    => 'raw',
                'label'     => 'Менеджер',
                'value'     => function ($data) use ($managers) {
                    return $data->personal_manager ? ('<i class="fa fa-user"></i> ' . $managers[$data->personal_manager] . ' (#' . $data->personal_manager . ')') : '';
                }
            ],
            //'is_active',
            //'created_at',
            //'phone',
            //'retail_discount',
            [
                'attribute' => 'wholesale',
                'format'    => 'raw',
                'label'     => 'Оптовик',
                'value'     => function ($data) {
                    return \app\models\Client::WHOLESALE_STATUSES[$data->wholesale] ?: 'Не оптовый';
                }
            ],
            //'subscribed',

            [
                'label'  => 'Actions',
                'format' => 'raw',
                'value'  => function ($data) {
                    return "<a href=\"/admin/clients/view?id=" . $data->id . "\" title=\"View\" aria-label=\"View\" data-pjax=\"0\"><span class=\"glyphicon glyphicon-eye-open\"></span></a> 
                            <a href=\"/admin/clients/update?id=" . $data->id . "\" title=\"Update\" aria-label=\"Update\" data-pjax=\"0\"><span class=\"glyphicon glyphicon-pencil\"></span></a>" . (\app\models\Admin::get()->is_superuser ? "<a href=\"/admin/clients/delete?id=" . $data->id . "\" title=\"Delete\" aria-label=\"Delete\" data-pjax=\"0\" data-confirm=\"Are you sure you want to delete this item?\" data-method=\"post\"><span class=\"glyphicon glyphicon-trash\"></span></a>" : "");
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
