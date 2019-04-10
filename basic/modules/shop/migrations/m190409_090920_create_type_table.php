<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%type}}`.
 */
class m190409_090920_create_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(22),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%type}}');
    }
}
