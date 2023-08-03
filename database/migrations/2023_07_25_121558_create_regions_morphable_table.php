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
        Schema::create('regions_has_receiver', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('region_id')->index('idx-regions_has_receiver-region_id');
            $table->morphs('receiverable');
            $table->timestamps();
            $table->foreign(
                'region_id',
                'fk-regions_has_receiver-region_id-regions-id'
            )
                ->references('id')
                ->on('regions')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions_morphable');
    }
};
