<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cat_product}}`.
 */
class m190409_074702_create_cat_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cat_product}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'category_id' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cat_product}}');
    }
}
