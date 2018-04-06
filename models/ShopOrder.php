<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_order".
 *
 * @property int    $id
 * @property int    $client_id
 * @property int    $manager_id
 * @property int    $created_by_id
 * @property double $sum
 * @property double $sum_discount
 * @property int    $delivery
 * @property double $delivery_price
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property string $email
 * @property string $items
 * @property int    $city
 * @property string $comment
 * @property int    $status
 * @property int    $created_at
 * @property int    $updated_at
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
            self::STATUS_NEW               => 'Новый',
            self::STATUS_PROCESSING        => 'Обработка',
            self::STATUS_MATCHING          => 'Согласование',
            self::STATUS_IN_WAREHOUSE      => 'На складе',
            self::STATUS_DELIVERING        => 'В доставке',
            self::STATUS_CLOSED            => 'Закрыт',
            self::STATUS_CANCELED          => 'Отменен',
            self::STATUS_SENDING           => 'Отправка',
            self::STATUS_COURIER           => 'Доставка курьера',
            self::STATUS_CANCELLED_BY_USER => 'Удален пользователем',
        ];
    }

    public static function getAdminStatuses()
    {
        return [
            self::STATUS_NEW               => '<span class="badge badge-danger"><i class="fa fa-exclamation-circle"></i> Новый</span>',
            self::STATUS_PROCESSING        => '<span class="badge badge-warning"><i class="fa fa-hourglass-start"></i> Обработка</span>',
            self::STATUS_MATCHING          => '<span class="badge badge-warning"><i class="fa fa-comments"></i> Согласование</span>',
            self::STATUS_IN_WAREHOUSE      => '<span class="badge badge-purple"><i class="fa fa-warehouse"></i> На складе</span>',
            self::STATUS_DELIVERING        => '<span class="badge badge-orange"><i class="fa fa-car"></i> В доставке</span>',
            self::STATUS_CLOSED            => '<span class="badge badge-success"><i class="fa fa-check-circle"></i> Закрыт</span>',
            self::STATUS_CANCELED          => '<span class="badge badge-secondary"><i class="fa fa-times"></i> Отменен</span>',
            self::STATUS_SENDING           => '<span class="badge badge-primary"><i class="fa fa-plane"></i> Отправка</span>',
            self::STATUS_COURIER           => '<span class="badge badge-orange"><i class="fa fa-male"></i> Доставка курьера</span>',
            self::STATUS_CANCELLED_BY_USER => '<span class="badge badge-secondary"><i class="fa fa-times"></i> Удален пользователем</span>',
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
            [['client_id', 'manager_id', 'created_by_id', 'city', 'status', 'created_at', 'updated_at', 'delivery'], 'integer'],
            [['sum', 'sum_discount', 'delivery_price'], 'number'],
            [['comment', 'items'], 'string'],
            [['address'], 'string', 'max' => 500],
            [['name'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'             => 'ID',
            'client_id'      => 'Client ID',
            'manager_id'     => 'Manager ID',
            'created_by_id'  => 'Created By ID',
            'sum'            => 'Sum',
            'sum_discount'   => 'Sum Discount',
            'delivery'       => 'Delivery',
            'delivery_price' => 'Delivery Price',
            'address'        => 'Address',
            'city'           => 'City',
            'comment'        => 'Comment',
            'status'         => 'Status',
            'created_at'     => 'Created At',
            'updated_at'     => 'Updated At',
        ];
    }
}
