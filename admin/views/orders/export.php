<?php

$items = [];
$items_array = json_decode($model->items, 1);

foreach (json_decode($model->items, 1) as $key => $value) $items[] = $key;

$items_query = implode(', ', $items);
if ($items_query) $items = \app\models\ShopProducts::find()
    ->where("id IN ($items_query)")
    ->all();

$xml = new SimpleXMLElement('<root/>');

$client = \app\models\Client::find()
    ->where(['id' => $model->client_id])
    ->limit(1)
    ->one();

$doc = $xml->addChild('doc');
$head = $doc->addChild('head');
$table = $doc->addChild('table');

$head->addChild('partner', $model->client_id);
$head->addChild('order', sha1($model->id));
$head->addChild('phone', $model->phone);
$head->addChild('email', $model->email);
$head->addChild('info', implode(', ', [
    $client->username ?: 'undefined',
    $client->last_name ?: 'undefined',
    $client->first_name ?: 'undefined',
    $model->phone,
    $model->email
]));
$head->addChild('date', Yii::$app->formatter->asDatetime($model->created_at, 'php: Y-m-d H:i:s'));

$mapped_items = [];

foreach ($items as $item) $mapped_items[$item->id] = $item;

foreach ($items_array as $key => $item) {
    $line = $table->addChild('line');

    $price = \app\models\General::actualPrice($mapped_items[$key], $client->id);

    $line->addChild('article', $mapped_items[$key]->vendor_code);
    $line->addChild('price', $price);
    $line->addChild('count', $item);
}


Header('Content-type: text/xml');

print($xml->asXML());

die();