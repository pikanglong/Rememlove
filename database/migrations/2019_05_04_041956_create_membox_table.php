<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membox', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('binding_id');
            $table->string('title');
            $table->string('contents');
            $table->string('img')->comment('储存图片的位置,多张图片用|分隔')->nullable();
            $table->date('time_see')->comment('允许查看的时间')->nullable();
            $table->string('password')->nullable();
            $table->string('tips')->nullable();
            $table->string('share_link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membox');
    }
}
