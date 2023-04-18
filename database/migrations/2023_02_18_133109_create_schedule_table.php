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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamp('execute_datetime');
            $table->string('garbage_type');
            $table->morphs('placeable');
            $table->timestamps();

            $table->unique(
                ['placeable_id', 'placeable_type', 'garbage_type', 'execute_datetime'],
                'idx-placeable_id-placeable_type-garbage_type-execute_datetime-schedules-unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
