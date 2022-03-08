<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            Config::get('custom-log.mysql.table'),
            function (Blueprint $table) {
                $table->engine = 'InnoDB';

                $table->bigIncrements('id');
                $table->text('message')->nullable();
                $table->string('channel')->nullable();
                $table->integer('level')->default(0);
                $table->string('level_name', 20)->index();
                $table->integer('unix_time');
                $table->text('datetime')->nullable();
                $table->longText('context')->nullable();
                $table->dateTime('emailed_at')->nullable();
                $table->text('extra')->nullable();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(Config::get('custom-log.mysql.table'));
    }
}
