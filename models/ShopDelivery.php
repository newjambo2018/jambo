<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_delivery".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $display_address_field
 */
class ShopDelivery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_delivery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 225],
            [['display_address_field'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'display_address_field' => 'Показывать поле для заполнения адреса',
        ];
    }
}
