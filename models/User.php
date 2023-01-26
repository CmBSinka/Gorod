<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $FIO
 * @property string|null $login
 * @property string|null $email
 * @property string|null $password
 * @property int $is_admin
 *
 * @property Request[] $requests
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_admin'], 'integer'],
            [['FIO', 'login', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'FIO' => 'ФИО',
            'login' => 'Логин',
            'email' => 'Почта',
            'password' => 'Пароль',
            'is_admin' => 'Is Admin',
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['user_id' => 'id']);
    }
    
    public static function findIdentity($id)
    {
    return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
    return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
    return $this->id;
    }

    public function getAuthKey()
    {
    return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
    return $this->authKey === $authKey;
    }
    public function validatePassword($password)
    {
        return $this->password == $password;
    }
    public static function findByEmail($email) 
    {
        return self::find()->where(['email' => $email])->one();
    }
}
