<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_order".
 *
 * @property int $id
 * @property int $client_id
 * @property int $manager_id
 * @property int $created_by_id
 * @property double $sum
 * @property double $sum_discount
 * @property int $delivery
 * @property double $delivery_price
 * @property string $address
 * @property int $city
 * @property string $comment
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class ShopOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'sum'], 'required'],
            [['client_id', 'manager_id', 'created_by_id', 'city', 'status', 'created_at', 'updated_at'], 'integer'],
            [['sum', 'sum_discount', 'delivery_price'], 'number'],
            [['comment'], 'string'],
            [['delivery'], 'string', 'max' => 2],
            [['address'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'manager_id' => 'Manager ID',
            'created_by_id' => 'Created By ID',
            'sum' => 'Sum',
            'sum_discount' => 'Sum Discount',
            'delivery' => 'Delivery',
            'delivery_price' => 'Delivery Price',
            'address' => 'Address',
            'city' => 'City',
            'comment' => 'Comment',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
