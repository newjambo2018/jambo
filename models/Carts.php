<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carts".
 *
 * @property int    $id
 * @property string $cart_id
 * @property int    $item_id
 * @property int    $count
 * @property int    $created_at
 */
class Carts extends \yii\db\ActiveRecord
{
    const DEFAUL_SALT = 'fABc3671889cAAEab&!(*HIKAnjkahs(*!';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carts';
    }

    public static function remove($item_id, $cart_id = false)
    {
        if (!$cart_id) $cart_id = General::getCookie('c_id');

        if (Carts::deleteAll(['item_id' => $item_id, 'cart_id' => $cart_id])) return true;

        return false;
    }

    public static function truncate($cart_id = false)
    {
        if (!$cart_id) $cart_id = General::getCookie('c_id');

        if (Carts::deleteAll(['cart_id' => $cart_id])) return true;

        return false;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cart_id', 'item_id', 'created_at'], 'required'],
            [['item_id', 'count', 'created_at'], 'integer'],
            [['cart_id'], 'string', 'max' => 32],
            [['cart_id', 'item_id'], 'unique', 'targetAttribute' => ['cart_id', 'item_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'cart_id'    => 'Cart ID',
            'item_id'    => 'Item ID',
            'count'      => 'Count',
            'created_at' => 'Created At',
        ];
    }

    public function append($item_id, $count)
    {
        if (!$this->cart_id) $this->cart_id = General::getCookie('c_id');

        $cart = Carts::find()
            ->where(['cart_id' => $this->cart_id])
            ->andWhere(['item_id' => $item_id])
            ->limit(1)
            ->one();

        if (!$cart) {
            $cart = $this;

            $cart->item_id = $item_id;
            $cart->count = 0;
            $cart->created_at = time();
        }

        $cart->count += $count;

        if (!$cart->save()) General::printR($cart->errors);
    }

    public function getItem()
    {
        return $this->hasOne(ShopProducts::className(), ['id' => 'item_id']);
    }

    public static function cartCount()
    {
        return Carts::find()
            ->where(['cart_id' => General::getCookie('c_id')])
            ->sum('count');
    }
}
