<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ShopCities */

$this->title = 'Create Shop Cities';
$this->params['breadcrumbs'][] = ['label' => 'Shop Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-cities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
