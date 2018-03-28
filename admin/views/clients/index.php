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

    <p>
        <?= Html::a('Create Client', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                'value'     => function ($data) use ($managers) {
                    return $data->personal_manager ? ('<i class="fa fa-user"></i> ' . $managers[$data->personal_manager] . ' (#' . $data->personal_manager . ')') : '';
                }
            ],
            //'is_active',
            //'created_at',
            //'phone',
            //'retail_discount',
            //'wholesale_discount',
            //'subscribed',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
