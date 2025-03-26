<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateReservationsStatusConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, drop the existing constraint
        DB::statement('ALTER TABLE reservations DROP CONSTRAINT IF EXISTS table_reservations_status_check');

        // Then add a new constraint with the additional status
        DB::statement("ALTER TABLE reservations ADD CONSTRAINT table_reservations_status_check CHECK (status::text = ANY (ARRAY['pending'::text, 'confirmed'::text, 'cancelled'::text, 'expired'::text, 'payment_failed'::text]))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert to the original constraint (adjust based on your original values)
        DB::statement('ALTER TABLE reservations DROP CONSTRAINT IF EXISTS table_reservations_status_check');
        DB::statement("ALTER TABLE reservations ADD CONSTRAINT table_reservations_status_check CHECK (status::text = ANY (ARRAY['pending'::text, 'confirmed'::text, 'cancelled'::text]))");
    }
}
