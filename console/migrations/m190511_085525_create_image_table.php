<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m190511_085525_create_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('image', [
            'id' => $this->primaryKey(),
            'gallery_id' => $this->integer(),
            'name' => $this->string()
        ]);

        $this->addForeignKey(
            'fk-gallery_id',
            'image',
            'gallery_id',
            'gallery',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-gallery_id','image');
        $this->dropTable('image');
    }
}
