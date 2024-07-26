<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('calculation_histories', function (Blueprint $table) {
            $table->id();
            $table->json('criteria'); // Store as JSON
            $table->json('alternatives'); // Store as JSON
            $table->json('values'); // Store as JSON
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calculation_histories');
    }
};
