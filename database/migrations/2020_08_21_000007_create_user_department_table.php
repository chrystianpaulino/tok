<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDepartmentTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'user_department';

    /**
     * Run the migrations.
     * @table user_department
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('user_id');
            $table->char('department_id', 32);

            $table->index(["user_id"], 'fk_users_has_departments_users1_idx');

            $table->index(["department_id"], 'fk_users_has_departments_departments1_idx');


            $table->foreign('user_id', 'fk_users_has_departments_users1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('department_id', 'fk_users_has_departments_departments1_idx')
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
