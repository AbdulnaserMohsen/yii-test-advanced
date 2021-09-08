<?php

use yii\db\Migration;

/**
 * Class m210906_125728_create_fulltext_index_on_video
 */
class m210906_125728_create_fulltext_index_on_video extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE {{%video}} ADD FULLTEXT(title,describtion,tags)");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210906_125728_create_fulltext_index_on_video cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210906_125728_create_fulltext_index_on_video cannot be reverted.\n";

        return false;
    }
    */
}
