<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_products".
 *
 * @property int    $id
 * @property string $name                Название
 * @property int    $product_id          ID Продукта
 * @property int    $category            Категория
 * @property int    $sub_category        Группа
 * @property string $gender              Пол
 * @property string $age                 Возраст
 * @property int    $brand               Бренд
 * @property string $barcode             Штрих-код
 * @property string $manufacturer_code   Код производителя
 * @property double $retail_price        Розничная цена
 * @property double $wholesale_price     Оптовая Цена
 * @property int    $vendor_code         Артикул
 * @property string $unit                Единица измерения
 * @property int    $quantity            Количество
 * @property double $old_retail_price    Старая Розничная  цена
 * @property double $old_wholesale_price Старая Оптовая Цена
 * @property int    $retail_stock        Розничная Акция
 * @property int    $wholesale_stock     Оптовая Акция
 * @property string $description
 * @property string $slug                Слаг
 * @property int    $created_at          Время создания
 */
class ShopProducts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'sub_category', 'brand', 'vendor_code', 'quantity', 'product_id', 'created_at'], 'integer'],
            [['gender', 'description'], 'string'],
            [['retail_price', 'wholesale_price', 'old_retail_price', 'old_wholesale_price'], 'number'],
            [['name'], 'string', 'max' => 350],
            [['slug'], 'string', 'max' => 450],
            [['age'], 'string', 'max' => 50],
            [['barcode'], 'string', 'max' => 32],
            [['manufacturer_code'], 'string', 'max' => 90],
            [['unit'], 'string', 'max' => 32],
            [['retail_stock', 'wholesale_stock'], 'integer'],
            [['product_id', 'category'], 'unique', 'targetAttribute' => ['product_id', 'category']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                  => 'ID',
            'name'                => 'Name',
            'category'            => 'Category',
            'sub_category'        => 'Sub Category',
            'gender'              => 'Gender',
            'age'                 => 'Age',
            'brand'               => 'Brand',
            'barcode'             => 'Barcode',
            'manufacturer_code'   => 'Manufacturer Code',
            'retail_price'        => 'Retail Price',
            'wholesale_price'     => 'Wholesale Price',
            'vendor_code'         => 'Vendor Code',
            'unit'                => 'Unit',
            'quantity'            => 'Quantity',
            'old_retail_price'    => 'Old Retail Price',
            'old_wholesale_price' => 'Old Wholesale Price',
            'retail_stock'        => 'Retail Stock',
            'wholesale_stock'     => 'Wholesale Stock',
            'description'         => 'Description',
        ];
    }
}
