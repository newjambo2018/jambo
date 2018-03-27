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
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $items
 * @property int $city
 * @property string $comment
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class ShopOrder extends \yii\db\ActiveRecord
{

    const STATUS_NEW = 1;
    const STATUS_PROCESSING = 2;
    const STATUS_MATCHING = 3;
    const STATUS_IN_WAREHOUSE = 4;
    const STATUS_DELIVERING = 5;
    const STATUS_CLOSED = 6;
    const STATUS_CANCELED = 7;
    const STATUS_SENDING = 8;
    const STATUS_COURIER = 9;
    const STATUS_CANCELLED_BY_USER = 10;

    public static function getStatuses()
    {
        return [
            self::STATUS_NEW => 'Новый',
            self::STATUS_PROCESSING => 'Обработка',
            self::STATUS_MATCHING => 'Согласование',
            self::STATUS_IN_WAREHOUSE => 'На складе',
            self::STATUS_DELIVERING => 'В доставке',
            self::STATUS_CLOSED => 'Закрыт',
            self::STATUS_CANCELED => 'Отменен',
            self::STATUS_SENDING => 'Отправка',
            self::STATUS_COURIER => 'Доставка курьера',
            self::STATUS_CANCELLED_BY_USER => 'Удален пользователем',
        ];
    }
    public static function getAdminStatuses()
    {
        return [
            self::STATUS_NEW => '<i class="fa fa-exclamation-circle"></i> Новый',
            self::STATUS_PROCESSING => '<i class="fa fa-hourglass-start"></i> Обработка',
            self::STATUS_MATCHING => '<i class="fa fa-comments"></i> Согласование',
            self::STATUS_IN_WAREHOUSE => '<i class="fa fa-warehouse"></i> На складе',
            self::STATUS_DELIVERING => '<i class="fa fa-car"></i> В доставке',
            self::STATUS_CLOSED => '<i class="fa fa-check-circle"></i> Закрыт',
            self::STATUS_CANCELED => '<i class="fa fa-times"></i> Отменен',
            self::STATUS_SENDING => '<i class="fa fa-plane"></i> Отправка',
            self::STATUS_COURIER => '<i class="fa fa-male"></i> Доставка курьера',
            self::STATUS_CANCELLED_BY_USER => '<i class="fa fa-times"></i> Удален пользователем',
        ];
    }

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
            [['client_id', 'sum', 'items'], 'required'],
            [['client_id', 'manager_id', 'created_by_id', 'city', 'status', 'created_at', 'updated_at'], 'integer'],
            [['sum', 'sum_discount', 'delivery_price'], 'number'],
            [['comment', 'items'], 'string'],
            [['delivery'], 'string', 'max' => 2],
            [['address'], 'string', 'max' => 500],
            [['name'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 225],
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
