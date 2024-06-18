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
        Schema::table('products', function (Blueprint $table) {
            $table->string('prop1', 32)->nullable()->after('user_id');
            $table->string('prop2', 32)->nullable()->after('prop1');
            $table->string('prop3', 32)->nullable()->after('prop2');
            $table->string('prop4', 32)->nullable()->after('prop3');
            $table->string('prop5', 32)->nullable()->after('prop4');
            $table->dropColumn('iso');
            $table->dropColumn('type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
