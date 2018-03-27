<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_order_items".
 *
 * @property int $id
 * @property int $order_id
 * @property int $item_id
 */
class ShopOrderItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_order_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'item_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'item_id' => 'Item ID',
        ];
    }
}
