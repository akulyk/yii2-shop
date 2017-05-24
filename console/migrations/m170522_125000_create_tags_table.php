<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tags`.
 */
class m170522_125000_create_tags_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_tags}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
        ], $tableOptions);
    }/**/

    public function down()
    {
        $this->dropTable('{{%shop_tags}}');
    }/**/

}/* end of Migration */
