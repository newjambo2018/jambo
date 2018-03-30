<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$items = [];
$items_array = json_decode($model->items, 1);

foreach (json_decode($model->items, 1) as $key => $value) $items[] = $key;

$items_query = implode(', ', $items);
if ($items_query) $items = \app\models\ShopProducts::find()
    ->where("id IN ($items_query)")
    ->all();

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Shop Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$managers = \yii\helpers\ArrayHelper::map(\app\models\Admin::find()
    ->all(), 'id', 'name');
$cities = \yii\helpers\ArrayHelper::map(\app\models\ShopCities::find()
    ->all(), 'id', 'name');

$delivery = \app\models\ShopDelivery::find()
    ->all();

$delivery_array = \yii\helpers\ArrayHelper::map($delivery, 'id', 'name');
$delivery_price_array = \yii\helpers\ArrayHelper::map($delivery, 'id', 'price');
?>
<div class="shop-order-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => 'Вы уверены, что хотите удалить этот заказ? Это действие НЕВОЗМОЖНО отменить.',
            ],
        ]) ?>

        <?= Html::a('Экспорт в ABC', ['export', 'id' => $model->id], [
            'class'    => 'btn btn-success',
            'download' => 'order_export_' . $model->id . '.xml'
        ]) ?>
        <?= Html::a('Накладная', ['invoice', 'id' => $model->id], [
            'class'  => 'btn btn-warning',
            'target' => '_blank'
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
                'attribute' => 'phone',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return '<i class="fa fa-phone"></i> <a href="tel:' . $data->phone . '">' . $data->phone . '</a>';
                }
            ],
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
                    return '<span style="color: red;">-<span id="total_sum_discount">' . $data->sum_discount . '</span> грн</span>';
                }
            ],
            [
                'attribute' => 'delivery',
                'format'    => 'raw',
                'value'     => function ($data) use ($delivery_array) {

                    return '<i class="fa fa-truck"></i> ' . ($delivery_array[$data->delivery] . '' ?: 'Нет');
                }
            ],
            [
                'attribute' => 'delivery_price',
                'format'    => 'raw',
                'value'     => function ($data) use ($delivery_price_array) {
                    return '<i class="fa fa-money-bill-alt"></i> ' . (number_format($delivery_price_array[$data->delivery], 2) . ' грн' ?: 'Нет');
                }
            ],
            'address',
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
                    return '<span id="current_status">' . \app\models\ShopOrder::getAdminStatuses()[$data->status] . '</span>';
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <div class="col-xs-12">
        <h3>Заказанные позиции</h3>

        <div class="col-xs-12">
            <div class="col-xs-4">
                <input type="text" class="form-control" id="vendor_code_field" placeholder="Добавить товар по артикулу">
            </div>
            <div class="col-xs-2">
                <button class="btn btn-success col-xs-12" data-add-by-vendor-code>К заказу</button>
            </div>
            <div class="col-xs-4">
                <select id="order_status_change" class="form-control">
                    <? foreach (\app\models\ShopOrder::getStatuses() as $key => $item) { ?>
                        <option value="<?= $key ?>" <?= $model->status === $key ? 'selected' : '' ?>><?= $item ?></option>
                    <? } ?>
                </select>
            </div>
            <div class="col-xs-2">
                <button class="btn btn-danger col-xs-12" data-change-status>Новый статус</button>
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

                        data = JSON.parse(data);

                        $('#total_sum').html(data['sum']);
                        $('#total_sum_discount').html(data['sum_discount']);
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

                        data = JSON.parse(data);

                        $('#total_sum').html(data['sum']);
                        $('#total_sum_discount').html(data['sum_discount']);
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
                        $('#total_sum_discount').html(data['sum_discount']);
                    }
                    else notify(data['message'], 'error')
                }
            )
        }).on('click', '[data-change-status]', function () {
            var status = $('#order_status_change').val();

            $.get(
                '/admin/orders/ajax-change-status',
                {
                    order_id: "<?= $model->id ?>",
                    status: status
                }, function (data) {
                    notify('Статус обновлен!<br><b>' + data + '</b>', 'success');
                    $('#current_status').html(data);
                }
            )
        })
    }
</script>