<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserConversationTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_conversation';

    /**
     * Run the migrations.
     * @table user_conversation
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('user_id');
            $table->char('conversation_id', 32);

            $table->index(["conversation_id"], 'fk_users_has_conversations_conversations1_idx');

            $table->index(["user_id"], 'fk_users_has_conversations_users1_idx');


            $table->foreign('user_id', 'fk_users_has_conversations_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('conversation_id', 'fk_users_has_conversations_conversations1_idx')
                ->references('id')->on('conversations')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
