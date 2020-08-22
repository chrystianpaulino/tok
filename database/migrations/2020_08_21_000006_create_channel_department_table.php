<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelDepartmentTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'channel_department';

    /**
     * Run the migrations.
     * @table channel_department
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('channel_id');
            $table->char('department_id', 32);

            $table->index(["channel_id"], 'fk_channels_has_departments_channels_idx');

            $table->index(["department_id"], 'fk_channels_has_departments_departments1_idx');


            $table->foreign('channel_id', 'fk_channels_has_departments_channels_idx')
                ->references('id')->on('channels')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('department_id', 'fk_channels_has_departments_departments1_idx')
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
