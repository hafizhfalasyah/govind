<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Occupation bersifat opsional di form user & admin (validasi nullable), jadi kolomnya harus boleh NULL.
     */
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('occupation')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('testimonials')->whereNull('occupation')->update(['occupation' => '']);

        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('occupation')->nullable(false)->change();
        });
    }
};
