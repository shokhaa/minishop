<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $qty
 * @property string $created_date
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'qty'], 'integer'],
            [['created_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'qty' => 'Qty',
            'created_date' => 'Created Date',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::classname(), ['id' => 'user_id']);
    }
    public function getProduct()
    {
        return $this->hasOne(Products::classname(), ['id' => 'product_id']);
    }
}
