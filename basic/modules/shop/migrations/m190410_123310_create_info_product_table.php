<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%info_product}}`.
 */
class m190410_123310_create_info_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%info_product}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'info_name' => $this->string(),
            'info_value' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%info_product}}');
    }
}
