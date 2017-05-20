<?php

use yii\db\Migration;

class m170520_221719_rename_user_table extends Migration
{
    public function up()
    {
        $this->renameTable('{{%user}}', '{{%users}}');
    }
    public function down()
    {
        $this->renameTable('{{%users}}', '{{%user}}');
    }
}/* end of Migration */
