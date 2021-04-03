<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('body');
            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('author_id')->unsigned();
            $table->timestamps();

            $table
                ->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->cascadeOnDelete();

                $table
                    ->foreign('author_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
