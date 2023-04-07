<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->foreignIdFor(
                \App\Models\User::class,
                "by_user_id"    // Can't be null. Will need to change your seed so you won't get an error
            )->constrained("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            // $table->foreignIdFor(
            //     \App\Models\Listing::class,
            //     "by_listing_id"   
            // )->constrained("listings");
        });
    }
};
