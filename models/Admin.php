<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admins".
 *
 * @property int    $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property int    $is_superuser
 * @property int    $active
 * @property int    $displayed
 * @property string $phone
 * @property string $telegram_id
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_superuser', 'active', 'displayed'], 'integer'],
            [['name', 'email', 'password', 'salt', 'phone', 'telegram_id'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => 'ID',
            'name'         => 'Name',
            'email'        => 'Email',
            'password'     => 'Password',
            'salt'         => 'Salt',
            'is_superuser' => 'Is Superuser',
            'active'       => 'Active',
        ];
    }

    /**
     * @return Admin
     */
    public static function get($from_db = false)
    {
        if ($from_db) return self::find()
            ->where(['id' => Admin::get()->id])
            ->limit(1)
            ->one();

        return General::getSession('admin_info');
    }

    public static function cryptPass($pass)
    {
        return base64_encode(sha1($pass . md5(':' . $pass)));
    }

    public static function isSuperuser()
    {
        return General::getSession('admin_info')->is_superuser;
    }

    public static function sendTelegramNotification($chat_id, $message)
    {
        $telegram = new Telegram();

        $telegram->sendMessage($chat_id, $message);
    }


    /**
     * @param ShopOrder $order
     */
    public static function orderNotification($order)
    {
        $items_count = count(json_decode($order->items, 1));
        $client = Client::find()
            ->where(['id' => $order->client_id])
            ->limit(1)
            ->one();

        $message = "Новый заказ!

🎁 Количество позиций: $items_count
💰 Сумма заказа: $order->sum грн
🏷 Скидка: -$order->sum_discount грн
";
        $message .= '👤 Клиент: ' . $order->name . ($client ? " (#$client->id)" : "") . "\n";
        $message .= '📞 Телефон: ' . $order->phone . "\n";

        if($client->wholesale) $message .= "\n☝️ Опт";
        else $message .= "\n☝️ Розница";

        $admin = Admin::find()
            ->where(['id' => $order->manager_id])
            ->limit(1)
            ->one();

        if ($admin && $telegram_id = $admin->telegram_id) self::sendTelegramNotification($telegram_id, $message);
    }
}
