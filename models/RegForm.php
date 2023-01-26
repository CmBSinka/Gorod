<?php
namespace app\models;

use app\models\User;

class RegForm extends User
{
    public $confirm_password;
    public $agree;

    public function rules()
    {
        return [
            [['FIO', 'email', 'password'], 'required'],
            [['is_admin'], 'integer'],
            [['FIO', 'email', 'password'], 'string', 'max' => 255],
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
            'email' => 'Email',
            'password' => 'Пароль',
            'is_admin' => 'Is Admin',
            'confirm_password' => 'Повторите пароль',
            'agree' => 'Подтвердите согласие на обработку персональных данных',
        ];
    }
}
?>