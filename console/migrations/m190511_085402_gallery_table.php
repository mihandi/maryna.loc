<?php

use yii\db\Migration;

/**
 * Class m190511_085402_gallery_table
 */
class m190511_085402_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('gallery', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(),
            'category_id'=>$this->integer(),
            'article_id'=>$this->integer(),
            'seo_url'=>$this->string(),
            'dir_name' => $this->string()->notNull()

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('gallery');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190511_085402_gallery_table cannot be reverted.\n";

        return false;
    }
    */
}
