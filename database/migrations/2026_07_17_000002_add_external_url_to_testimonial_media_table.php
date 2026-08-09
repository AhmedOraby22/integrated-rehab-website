<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonial_media', function (Blueprint $table) {
            $table->string('external_url', 500)->nullable()->after('file_path');
        });

        DB::statement('ALTER TABLE testimonial_media MODIFY file_path VARCHAR(255) NULL');
    }

    public function down(): void
    {
        DB::statement("UPDATE testimonial_media SET file_path = '' WHERE file_path IS NULL");
        DB::statement('ALTER TABLE testimonial_media MODIFY file_path VARCHAR(255) NOT NULL');

        Schema::table('testimonial_media', function (Blueprint $table) {
            $table->dropColumn('external_url');
        });
    }
};
