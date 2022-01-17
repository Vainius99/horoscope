<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreateHoroscopeScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horoscope_scores', function (Blueprint $table) {
            $table->id();
            $table->string('dayscore');
            $table->date('day');
            $table->unsignedBigInteger('year_id');
            $table->unsignedBigInteger('sign_id')->nullable();
            $table->foreign('year_id')->references('id')->on('horoscopes')->onDelete('cascade');
            $table->foreign('sign_id')->references('id')->on('horoscope_signs')->onDelete('set null');
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
        Schema::dropIfExists('horoscope_scores');
    }
}
