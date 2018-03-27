<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "client_activation".
 *
 * @property int $id
 * @property int $client_id
 * @property string $code
 */
class ClientActivation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_activation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id'], 'integer'],
            [['code'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'code' => 'Code',
        ];
    }
}
