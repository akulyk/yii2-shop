<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_brands`.
 */
class m170522_124936_create_shop_brands_table extends Migration
{
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        $this->createTable('{{%shop_brands}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'meta_json' => 'JSON NOT NULL',
        ], $tableOptions);
    }/**/

    public function down()
    {
        $this->dropTable('{{%shop_brands}}');
    }/**/

}/* end of Migration */
