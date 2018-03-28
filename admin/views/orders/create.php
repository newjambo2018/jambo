<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ShopOrder */

$this->title = 'Create Shop Order';
$this->params['breadcrumbs'][] = ['label' => 'Shop Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
