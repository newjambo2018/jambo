<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ShopProducts */

$this->title = 'Update Shop Products: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Shop Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shop-products-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
