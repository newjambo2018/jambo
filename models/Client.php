<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int    $id
 * @property string $username
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $is_active
 * @property int    $created_at
 * @property string $phone
 * @property double $retail_discount
 * @property double $wholesale_discount
 * @property int    $subscribed
 */
class Client extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'integer'],
            [['retail_discount', 'wholesale_discount'], 'number'],
            [['username', 'email', 'first_name', 'last_name', 'is_active'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 30],
            [['subscribed'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                 => 'ID',
            'username'           => 'Username',
            'email'              => 'Email',
            'first_name'         => 'First Name',
            'last_name'          => 'Last Name',
            'is_active'          => 'Is Active',
            'created_at'         => 'Created At',
            'phone'              => 'Phone',
            'retail_discount'    => 'Retail Discount',
            'wholesale_discount' => 'Wholesale Discount',
            'subscribed'         => 'Subscribed',
        ];
    }

    function password_verify($password, $djangoHash)
    {
        $pieces = explode('$', $djangoHash);
        if (count($pieces) !== 4) {
            return false;
        }
        list($header, $iter, $salt, $hash) = $pieces;
        // Get the hash algorithm used:
        if (preg_match('#^pbkdf2_([a-z0-9A-Z]+)$#', $header, $m)) {
            $algo = $m[1];
        } else {
            return false;
        }

        if (!in_array($algo, hash_algos())) {
            return false;
        }



        $calc = hash_pbkdf2($algo, $password, $salt, (int)$iter, 32, true);

        return hash_equals($calc, base64_decode($hash));
    }
}
