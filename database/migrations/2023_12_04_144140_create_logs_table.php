<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable();
            $table->ipAddress('user_ip');
            $table->string('request_method');
            $table->string('api_address');
            $table->text('parameters')->nullable();
            $table->text('response_parameters')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamp('request_time');
            $table->float('service_processing_time')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
