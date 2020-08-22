<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelDepartmentTable extends Migration
{

    /**
     * Run the migrations.
     * @table channel_department
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_department', function (Blueprint $table) {
            $table->uuid('channel_id')->index();
            $table->uuid('department_id')->index();

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
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channel_department');
    }
}
