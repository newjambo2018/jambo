<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shop_cats".
 *
 * @property int    $id
 * @property string $name
 */
class ShopCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_cats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'   => 'ID',
            'name' => 'Name',
        ];
    }

    public function getSubcats()
    {
        return $this->hasMany(ShopSubCategories::className(), ['category_id' => 'id']);
    }
}
