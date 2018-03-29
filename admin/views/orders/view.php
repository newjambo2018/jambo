<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ShopOrder */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Shop Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$managers = \yii\helpers\ArrayHelper::map(\app\models\Admin::find()
    ->all(), 'id', 'name');
$cities = \yii\helpers\ArrayHelper::map(\app\models\ShopCities::find()
    ->all(), 'id', 'name');
?>
<div class="shop-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model'      => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'client_id',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return "<a href=\"/admin/clients/view?id={$data->client_id}\">(#{$data->client_id}) {$data->name}</a>";
                }
            ],
            [
                'attribute' => 'manager_id',
                'format'    => 'raw',
                'label'     => 'Идентификатор менеджера',
                'value'     => function ($data) use ($managers) {
                    return "(#{$data->manager_id}) " . $managers[$data->manager_id];
                }
            ],
            [
                'attribute' => 'created_by_id',
                'format'    => 'raw',
                'label'     => 'Создан вручную менеджером',
                'value'     => function ($data) {
                    return $data->created_by_id ?: 'Нет';
                }
            ],
            [
                'attribute' => 'name',
                'label'     => 'Имя'
            ],
            'email:email',
            [
                'attribute' => 'sum',
                'format'    => 'raw',
                'label'     => 'Сумма',
                'value'     => function ($data) {
                    return '<span style="color: green;"><i class="fa fa-money"></i> <span id="total_sum">' . $data->sum . '</span> грн</span>';
                }
            ],
            [
                'attribute' => 'sum_discount',
                'format'    => 'raw',
                'label'     => 'Сумма скидки',
                'value'     => function ($data) {
                    return '<span style="color: red;">-' . $data->sum_discount . ' грн</span>';
                }
            ],
            //            'delivery',
            //            'delivery_price',
            //            'address',
            [
                'attribute' => 'city',
                'format'    => 'raw',
                'label'     => 'Город',
                'value'     => function ($data) use ($cities) {
                    return $cities[$data->city];
                }
            ],
            [
                'attribute' => 'comment',
                'format'    => 'raw',
                'label'     => 'Комментарий покупателя'
            ],
            [
                'attribute' => 'status',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return \app\models\ShopOrder::getAdminStatuses()[$data->status];
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <div class="col-xs-12">
        <h3>Заказанные позиции</h3>
        <?

        $items = [];

        foreach (json_decode($model->items, 1) as $key => $value) $items[] = $key;

        $items_query = implode(', ', $items);
        if ($items_query) $items = \app\models\ShopProducts::find()
            ->where("id IN ($items_query)")
            ->all();
        ?>

        <div class="col-xs-12">
            <div class="col-xs-5"><input type="text" class="form-control" id="vendor_code_field" placeholder="Добавить товар по артикулу"></div>
            <div class="col-xs-2">
                <button class="btn btn-success" data-add-by-vendor-code>К заказу</button>
            </div>
        </div>

        <div class="order_items_list">
            <? foreach ($items as $item) { ?>
                <?= $this->render('item', ['item' => $item, 'model' => $model]) ?>
            <? } ?>
        </div>
    </div>

</div>


<script>
    window.onload = function () {
        $(document).on('change', '[data-item-id]', function () {
            var _this = $(this);

            $.get(
                '/admin/orders/ajax-quantity',
                {
                    order_id: _this.data('item'),
                    item_id: _this.data('item-id'),
                    quantity: _this.val()
                }, function (data) {
                    if (data !== 'error') {
                        notify('Информация обновлена', 'success');
                        $('#total_sum').html(data);
                    }
                    else notify('Ошибка! Информация НЕ обновлена! Попробуйте еще раз.', 'error')
                }
            )
        }).on('click', '[data-delete]', function () {
            var _this = $(this);

            $.get(
                '/admin/orders/ajax-delete',
                {
                    order_id: _this.data('item'),
                    item_id: _this.data('delete')
                }, function (data) {
                    if (data !== 'error') {
                        notify('Позиция удалена', 'success');
                        $('[data-order-item=' + _this.data('delete') + ']').remove();
                        $('#total_sum').html(data);
                    }
                    else notify('Ошибка! Попробуйте еще раз.', 'error')
                }
            )
        }).on('click', '[data-add-by-vendor-code]', function () {
            var vendor_code = $('#vendor_code_field').val();

            $.get(
                '/admin/orders/ajax-add-by-vendor-code',
                {
                    order_id: "<?= $model->id ?>",
                    vendor_code: vendor_code
                }, function (data) {
                    data = JSON.parse(data);

                    if (data['status'] === 'success') {
                        notify('Позиция добавлена к заказу!', 'success');

                        $('.order_items_list').append(data['data']);

                        $('#total_sum').html(data['sum']);
                    }
                    else notify(data['message'], 'error')
                }
            )
        })
    }
</script>