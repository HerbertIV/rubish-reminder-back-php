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
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->string('event_name', 255)->nullable();
            $table->string('mail_from', 125)->nullable();
            $table->string('subject', 255)->nullable();
            $table->text('content')->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign(
                'updated_by',
                'fk-templates-updated_by-admins-id'
            )->on('admins')->references('id')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('templates');
    }
};
