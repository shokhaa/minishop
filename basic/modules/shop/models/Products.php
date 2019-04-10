<?php

namespace app\modules\shop\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $title
 * @property double $price
 * @property string $description
 * @property int $type_id
 * @property double $price_to
 * @property int $category

 *
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price', 'price_to'], 'number'],
            [['price', 'title', 'description'], 'required'],
            [['description'], 'string'],
            [['type_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'price' => 'Price',
            'description' => 'Description',
            'type_id' => 'Type ID',
            'price_to' => 'Price To',
        ];
    }

    public function getType()
    {
        return $this->hasOne(Type::classname(), ['id' => 'type_id']);
    }

    //select cat id
    public function getCat(){
        return $this->hasMany(CatProduct::classname(), ['product_id' => 'id']);
    }

    //insert all category title and id
    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('cat_product', ['product_id' => 'id']);
    }
}
