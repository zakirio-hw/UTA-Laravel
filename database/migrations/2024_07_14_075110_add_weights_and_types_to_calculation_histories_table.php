<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWeightsAndTypesToCalculationHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calculation_histories', function (Blueprint $table) {
            $table->json('weights')->after('values');
            $table->json('types')->after('weights');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calculation_histories', function (Blueprint $table) {
            $table->dropColumn(['weights', 'types']);
        });
    }
}

