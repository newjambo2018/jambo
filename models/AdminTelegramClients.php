<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin_telegram_clients".
 *
 * @property int $id
 * @property string $telegram_id
 * @property int $code_id
 */
class AdminTelegramClients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_telegram_clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code_id'], 'integer'],
            [['telegram_id'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'telegram_id' => 'Telegram ID',
            'code_id' => 'Code ID',
        ];
    }
}
