<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video}}`.
 */
class m210902_205102_create_video_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video}}', [
            'video_id' => $this->string(16)->notNull(),
            'title' => $this->string(512)->notNull(),
            'describtion' => $this->text(),
            'tags' => $this->string(512),
            'video_name' => $this->string(512),
            'has_thumbnail' => $this->boolean(),
            'status' => $this->integer(1),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(11),
        ]);

        $this->addPrimaryKey('PK_video_video_id','{{%video}}','video_id');

        $this->createIndex(
          '{{%idx-video-created_by}}',
          '{{%video}}',
          'created_by'
        );
        $this->addForeignKey(
          '{{%idx-video-created_by}}',
          '{{%video}}',
          'created_by',
          '{{%user}}',
          'id',
          'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%video}}');
    }
}
