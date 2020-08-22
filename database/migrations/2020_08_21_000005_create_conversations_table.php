<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{

    /**
     * Run the migrations.
     * @table conversations
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->uuid('id')->index();
            $table->uuid('channel_id')->index();
            $table->uuid('department_id')->index();
            $table->uuid('cliente_id')->index();
            $table->string('name');
            $table->string('cpf');
            $table->string('telefone');
            $table->string('status', 2)->default('01');
            $table->softDeletes();

            $table->foreign('channel_id')
                ->references('id')
                ->on('channels')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('cliente_id')
                ->references('id')
                ->on('clientes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conversations');
    }
}
