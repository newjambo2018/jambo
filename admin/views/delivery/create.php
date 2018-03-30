<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ShopDelivery */

$this->title = 'Create Shop Delivery';
$this->params['breadcrumbs'][] = ['label' => 'Shop Deliveries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-delivery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
