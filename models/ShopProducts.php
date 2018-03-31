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
            'name'                => 'Наименование',
            'category'            => 'Категория',
            'sub_category'        => 'Подкатегория',
            'gender'              => 'Пол',
            'age'                 => 'Возраст',
            'brand'               => 'Бренды',
            'barcode'             => 'Штрихкод',
            'manufacturer_code'   => 'Код производителя',
            'retail_price'        => 'Розничная цена',
            'wholesale_price'     => 'Оптовая цена',
            'vendor_code'         => 'Артикул',
            'unit'                => 'Единица измерения',
            'quantity'            => 'Количество',
            'old_retail_price'    => 'Старая розничная цена',
            'old_wholesale_price' => 'Старая оптовая цена',
            'retail_stock'        => 'Акция Розничная',
            'wholesale_stock'     => 'Акция Оптовая',
            'description'         => 'Описание',
            'product_id'          => 'Номер продукта (1C)',
        ];
    }
}
