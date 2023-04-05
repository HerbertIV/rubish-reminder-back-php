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
        Schema::table('users', function (Blueprint $table) {
            $table->string('email_from_process', 110)->nullable();
            $table->timestamp('process_email_expire_at')->nullable();
            $table->string('phone_from_process', 20)->nullable();
            $table->timestamp('process_phone_expire_at')->nullable();
            $table->string('process_token', 128)->nullable();
            $table->string('sms_code', 6)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'email_from_process',
                'process_email_expire_at',
                'phone_from_process',
                'process_phone_expire_at',
                'process_token',
                'sms_code'
            ]);
        });
    }
};
