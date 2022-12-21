<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%images}}`.
 */
class m221219_162748_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%images}}', [
            'id' => $this->primaryKey(),
			'filename' => $this->string(255)->notNull(),
			'uploaded' => $this->dateTime()
        ]);
    }
	
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%images}}');
    }
}
