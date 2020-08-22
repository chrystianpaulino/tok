<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'conversations';

    /**
     * Run the migrations.
     * @table conversations
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->char('channel_id', 32);
            $table->char('department_id', 32);
            $table->string('departament_name', 45)->nullable();
            $table->string('name', 45)->nullable();
            $table->string('cpf', 45)->nullable();
            $table->string('telefone', 45)->nullable();
            $table->char('status', 1)->nullable();

            $table->index(["channel_id"], 'fk_conversations_channels1_idx');

            $table->index(["department_id"], 'fk_conversations_departments1_idx');


            $table->foreign('channel_id', 'fk_conversations_channels1_idx')
                ->references('id')->on('channels')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('department_id', 'fk_conversations_departments1_idx')
                ->references('id')->on('departments')
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
