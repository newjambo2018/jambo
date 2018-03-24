<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_sub_cats".
 *
 * @property int    $id
 * @property int    $category_id
 * @property string $name
 */
class ShopSubCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_sub_cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['category_id', 'name'], 'unique', 'targetAttribute' => ['category_id', 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'category_id' => 'Category ID',
            'name'        => 'Name',
        ];
    }
}
