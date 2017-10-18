<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transfer`.
 */
class m171014_130621_create_transfer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('transfer', [
            'id' => $this->primaryKey(),
            'sender_id' => $this->integer(),
            'reciever_id' => $this->integer(),
            'amount' => $this->float(),
        ]);
        
        $this->addForeignKey(
            'sender_id',
            'reciever_id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey(
            'sender_id',
            'reciever_id'
        );
         
        $this->dropTable('transfer');
    }
}
