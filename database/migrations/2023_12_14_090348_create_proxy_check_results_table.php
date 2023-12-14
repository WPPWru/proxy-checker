<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proxy_check_results', function (Blueprint $table) {
            $table->id();
            $table->string('proxy');
            $table->boolean('is_worked_status');
            $table->string('type');
            $table->string('country');
            $table->string('city');
            $table->string('speed');
            $table->string('external_ip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proxy_check_results');
    }
};
