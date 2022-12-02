<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_settings', function (Blueprint $table) {
            $table->id();
            $table->string('greeting_1')->nullable();
            $table->string('greeting_2')->nullable();
            $table->string('greeting_3')->nullable();
            $table->boolean('signature_line');
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
        Schema::dropIfExists('ticket_settings');
    }
};
