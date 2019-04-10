<?php
/**
 * Created by PhpStorm.
 * User: Shokhaa
 * Date: 4/10/19
 * Time: 10:29 AM
 */

//namespace app\models;
namespace app\modules\shop\models;

use yii\base\Model;

class SignupForm extends Model{

    public $username;
    public $password;

    public function rules() {
        return [
            [['username', 'password'], 'required', 'message' => 'Заполните поле'],
            ['username', 'unique', 'targetClass' => User::className(),  'message' => 'Этот логин уже занят'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
        ];
    }

}