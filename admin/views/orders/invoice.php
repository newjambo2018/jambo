<?php
/**
 * @var \app\models\ShopOrder    $model
 * @var \app\models\ShopProducts $item
 * @var \app\models\Client       $client
 * @var \app\models\ShopDelivery $delivery
 */

$delivery = \app\models\ShopDelivery::findOne($model->delivery);

$items = [];
$items_array = json_decode($model->items, 1);

foreach (json_decode($model->items, 1) as $key => $value) $items[] = $key;

$items_query = implode(', ', $items);
if ($items_query) $items = \app\models\ShopProducts::find()
    ->where("id IN ($items_query)")
    ->all();

$mapped_items = [];

foreach ($items as $item) $mapped_items[$item->id] = $item;

$client = \app\models\Client::findOne($model->client_id);
?>
    <style>
        body {
            padding: 60px 60px 55px 60px;
            font-size: 14px;
        }

        .print-table {
            border-collapse: collapse;
            border-spacing: 0;
            color: #000;
            border: 0px;
            font-size: 13px;
            width: 100%;
            padding: 0;
            margin: 0;
        }

        .print-table thead h1 {
            text-align: center;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            padding: 3px 4px;
        }

        .table td {
            border: 1px solid #000;
        }

        .header {
            border: none;
            border-collapse: collapse;
        }

        .header td {
            padding: 0 10px 10px 0;
        }

        .table thead td {
            font-weight: bold;
            background-color: #CCC;
            text-align: center;
        }

        .table tr.total td {
            text-align: right;
            padding-right: 5px;
            padding: 5px;
            border: 0;
        }

        .table tr.total td.border {
            border: 1px solid black;
            font-weight: bold;

            text-align: center;
            font-size: 15px;
        }

        .sign {
            border: none;
            border-collapse: collapse;
        }

        .sign td {
            padding: 5px 3px;
            text-align: right;
        }

        .pdv {
            width: 50px;
            display: inline-block;
        }

        tr.total td {
            text-align: center;
        }

        table.table td {
            text-align: center;
        }
    </style>
    <table class="print-table">
        <thead>
        <tr>
            <td>
                <table class="header">
                    <tbody>
                    <tr valign="top">
                        <td style="text-align: right"><u>Постачальник</u></td>
                        <td>Jambo</td>
                    </tr>
                    <tr valign="top">
                        <td style="text-align: right"><u>Одержувач</u></td>
                        <td>
                            <strong><?= $model->name ?> </strong>
                            <br>
                            <?= $model->phone ?>
                            <br>
                            <?= $model->email ?>
                            <br>
                            Доставка: <?= $delivery->name ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <h1>Рахунок-фактура №<?= number_format($model->id, 0, '.', ' ') ?> <br> від <?= Yii::$app->formatter->asDate($model->created_at, 'php: d.m.Y') ?></h1>
            </td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <table class="table">
                    <thead>
                    <tr>
                        <td width="25"><strong>№</strong></td>
                        <td width="100"><strong>Код</strong></td>
                        <td><strong>Товар</strong></td>
                        <td width="70" align="center"><strong>Кількість</strong></td>
                        <td width="60"><strong>Одиниця</strong></td>
                        <td width="90" align="center"><strong>Ціна</strong></td>
                        <td width="90" align="center"><strong>Знижка</strong></td>
                        <td width="90" align="center"><strong>Ціна зі знижкою</strong></td>
                    </tr>
                    </thead>

                    <tbody>
                    <? $i = 0; ?>
                    <? foreach ($items_array as $key => $quantity) { ?>
                        <?
                        ++$i;
                        $actual_price = \app\models\General::actualPrice($mapped_items[$key], $model->client_id ?: false);
                        $regular_price = $client->wholesale ? $mapped_items[$key]->wholesale_price : $mapped_items[$key]->retail_price;
                        ?>
                        <tr>
                            <td align="center">
                                <?= $i ?>
                            </td>
                            <td align="center">
                                <?= $mapped_items[$key]->vendor_code ?>
                            </td>
                            <td style="text-align: left; padding-left: 20px">
                                <?= $mapped_items[$key]->name ?>
                                <br>
                            </td>
                            <td align="right">
                                <?= $quantity ?>
                            </td>
                            <td align="center">
                                <?= $mapped_items[$key]->unit ?>
                            </td>
                            <td align="right">
                                <?= number_format($regular_price, 2, ',', ' ') ?> грн
                            </td>
                            <td align="center">
                                <?= $regular_price - $actual_price ? number_format($regular_price - $actual_price, 2, ',', ' ') . ' грн': 'Відсутня' ?>
                            </td>
                            <td align="right">
                                <?= number_format($actual_price, 2, ',', ' ') ?> грн
                            </td>
                        </tr>
                    <? } ?>


                    <tr class="total">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td style="text-align: left; padding-left: 20px" class="border">
                            <?= $i ?>
                        </td>
                        <td colspan="2" align="right">Сума без знижки</td>
                        <td align="right" class="border">
                            <?= number_format($model->sum + $model->sum_discount, 2, ',', ' ') ?> грн
                        </td>
                    </tr>
                    <tr class="total">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" align="right">
                            Сума зі знижкою
                        </td>
                        <td align="right" class="border">
                            <?= number_format($model->sum, 2, ',', ' ') ?> грн
                        </td>
                    </tr>
                    <tr class="total">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" align="right">
                            Доставка
                        </td>
                        <td align="right" class="border">
                            <?= number_format($delivery->price, 2, ',', ' ') ?> грн
                        </td>
                    </tr>
                    <tr class="total">
                        <td>&nbsp;</td>
                        <td>
                            &nbsp;
                        </td>
                        <td>&nbsp;</td>
                        <td colspan="2" align="right">ПДВ</td>
                        <td align="right" class="border">
                            Без ПДВ
                        </td>
                    </tr>
                    <tr class="total">
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td colspan="2" align="right">
                            Всього з ПДВ
                        </td>
                        <td align="right" class="border">
                            <?= number_format($model->sum + $delivery->price, 2, ',', ' ') ?> грн
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
        <tfoot>
        <tr>
            <td>
                <br>
                <br>

                <table align="right" class="sign">
                    <tbody>
                    <tr align="right">


                    </tr>
                    </tbody>
                </table>
                <br>
            </td>
        </tr>
        </tfoot>
    </table>

<? die(); ?>