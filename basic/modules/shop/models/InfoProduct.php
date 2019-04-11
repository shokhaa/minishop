<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "info_product".
 *
 * @property int $id
 * @property int $product_id
 * @property string $info_name
 * @property string $info_value
 */
class InfoProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'info_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['info_name', 'info_value'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'info_name' => 'Info Name',
            'info_value' => 'Info Value',
        ];
    }
}
