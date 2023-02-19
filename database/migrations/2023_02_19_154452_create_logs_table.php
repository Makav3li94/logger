<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('log_date');
            $table->string('service_name', 55);
            $table->string('request_type',33);
            $table->string('request_route',55);
            $table->string('request_header',155);
            $table->unsignedInteger('response_type');
            $table->unique(['log_date', 'service_name','request_type','response_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
};
