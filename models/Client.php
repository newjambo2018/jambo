<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int    $id
 * @property string $username    +
 * @property string $password    +
 * @property string $salt        +
 * @property string $email       +
 * @property string $first_name  +
 * @property string $last_name   +
 * @property string $is_active
 * @property int    $created_at
 * @property string $phone       +
 * @property double $retail_discount
 * @property double $wholesale_discount
 * @property int    $subscribed
 * @property int    $personal_manager
 * @property int    $wholesale
 * @property int    $wholesale_timecycle
 * @property int    $can_download_price
 */
class Client extends \yii\db\ActiveRecord
{
    const WHOLESALE_AWAITING = 2;
    const WHOLESALE_ACTIVE = 1;
    const WHOLESALE_DECLINED = 3;

    const WHOLESALE_STATUSES = [
        self::WHOLESALE_AWAITING => '<span class="badge badge-warning"><i class="fa fa-spinner fa-spin"></i> Ожидает</span>',
        self::WHOLESALE_ACTIVE   => '<span class="badge badge-success"><i class="fa fa-check-circle"></i> Подтвержден</span>',
        self::WHOLESALE_DECLINED => '<span class="badge badge-danger"><i class="fa fa-times-circle"></i> Отвергнут</span>',
    ];

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
            [['email', 'username', 'first_name', 'last_name', 'phone', 'password'], 'required'],
            [['created_at', 'personal_manager', 'wholesale_timecycle', 'subscribed', 'is_active', 'wholesale', 'can_download_price'], 'integer'],
            [['retail_discount', 'wholesale_discount'], 'number'],
            [['username', 'email', 'first_name', 'last_name', 'password'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 30],
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
            'email'              => 'E-mail',
            'first_name'         => 'Имя',
            'last_name'          => 'Фамилия',
            'is_active'          => 'Активирован',
            'created_at'         => 'Создан',
            'phone'              => 'Телефон',
            'retail_discount'    => 'Розничная скидка',
            'wholesale_discount' => 'Оптовая скидка',
            'subscribed'         => 'Подписан',
            'wholesale'          => 'Оптовик',
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

    public function restorePassword()
    {
        $this->salt = General::newToken();
        $new_password = Yii::$app->security->generateRandomString(8);
        $this->password = md5($this->salt . ':' . md5($new_password));

        $this->save();

        Yii::$app->mailer->compose('restore', [
            'client'   => $this,
            'password' => $new_password
        ])
            ->setTo($this->email)
            ->setSubject('Восставновление пароля на JAMBO')
            ->send();
    }
}
