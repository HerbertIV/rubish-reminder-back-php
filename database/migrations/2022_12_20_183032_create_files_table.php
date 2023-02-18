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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->uuidMorphs('model');
            $table->string('name', 128);
            $table->string('file_name', 255);
            $table->string('mime_type', 30)->nullable();
            $table->integer('size')->default(0);
            $table->json('conversions')->nullable();
            $table->string('disk', 255);
            $table->string('collection_name', 128);
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
        Schema::dropIfExists('files');
    }
};
