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
            [['is_superuser', 'active'], 'integer'],
            [['name', 'email', 'password', 'salt'], 'string', 'max' => 225],
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
    public static function get()
    {
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
}
