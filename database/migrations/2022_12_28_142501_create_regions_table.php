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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('name', 255);
            $table->timestamps();

            $table->foreign(
                'parent_id',
                'fk-regions-parent_id-regions-id'
            )->on('regions')->references('id')->restrictOnDelete();
        });
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('region_id')->unsigned();
            $table->string('name', 255);
            $table->timestamps();

            $table->foreign(
                'region_id',
                'fk-cities-region_id-regions-id'
            )->on('regions')->references('id')->restrictOnDelete();
        });
        Schema::create('city_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign(
                'city_id',
                'fk-city_user-city_id-cities-id'
            )->on('cities')->references('id')->restrictOnDelete();
            $table->foreign(
                'user_id',
                'fk-city_user-user_id-users-id'
            )->on('users')->references('id')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
        Schema::dropIfExists('cities');
        Schema::dropIfExists('city_user');
    }
};
