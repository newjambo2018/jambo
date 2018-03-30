<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ShopCities */

$this->title = 'Update Shop Cities: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Shop Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shop-cities-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
