<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cartt}}`.
 */
class m190409_080853_create_cartt_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qty' => $this->integer(),
            'created_date' => $this->date()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cartt}}');
    }
}
