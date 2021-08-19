<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->unsignedInteger('provider_id');
            $table->string('name')->nullable();
            $table->string('media')->nullable();
            $table->enum('type', ['0', '1'])->comment('0: Image; 1: Video')->default('0');
            $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
