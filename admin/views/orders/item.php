<?

use app\models\General;

?>

<div class="col-xs-12" data-order-item="<?= $item->id ?>" style="border: 1px solid #eee;padding: 10px;margin-top: 10px;">
    <div class="col-xs-1 text-center">
        <img src="/images/product-details/1.jpg" alt="" style="max-height: 50px">
    </div>
    <div class="col-xs-5" style="padding-top: 15px">
        <a href="/admin/products/view?id=<?= $item->id ?>" target="_blank"><?= $item->name ?> <b>Артикул: <?= $item->vendor_code ?></b></a>
    </div>
    <div class="col-xs-2 text-center" style="padding-top: 8px">
        <input type="number" class="form-control" data-item="<?= $model->id ?>" data-item-id="<?= $item->id ?>" value="<?= json_decode($model->items, 1)[$item->id] ?>">
    </div>
    <div class="col-xs-3 text-center" style="padding-top: 15px;font-size: 17px">
        <?= number_format(General::actualPrice($item, $model->client_id ?: false), 2) ?> грн
    </div>
    <div class="col-xs-1 text-center" style="padding-top: 10px;cursor:pointer;">
        <i class="fa fa-times" style="font-size: 25px" data-item="<?= $model->id ?>" data-delete="<?= $item->id ?>"></i>
    </div>
</div>