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
            [['FIO', 'email', 'login', 'password'], 'required'],
            [['FIO'], 'match', 'pattern'=>'/^[А-ЯЁа-яё\s\-]{1,}$/u', 'message'=>'Используйте минимум 1 русскую букву, пробел или тире'],
            [['login'], 'match', 'pattern'=>'/^[A-Za-z]*$/u', 'message'=>'Используйте только латинские буквы'],
            [['login'], 'unique'],
            [['email'], 'email'],
            [['is_admin'], 'integer'],
            [['FIO', 'email', 'login' ,'password'], 'string', 'max' => 255],
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