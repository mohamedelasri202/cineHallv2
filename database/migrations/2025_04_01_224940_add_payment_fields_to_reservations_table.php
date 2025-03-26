<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // In the migration file
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->timestamp('expires_at')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('payment_status')->nullable();

        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn(['expires_at', 'payment_id', 'payment_status']);
        });
    }
};
