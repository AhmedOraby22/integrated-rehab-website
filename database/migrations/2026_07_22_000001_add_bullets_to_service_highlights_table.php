<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_highlights', function (Blueprint $table) {
            $table->json('bullets')->nullable()->after('title');
            $table->string('cta_label')->nullable()->after('bullets');
        });
    }

    public function down(): void
    {
        Schema::table('service_highlights', function (Blueprint $table) {
            $table->dropColumn(['bullets', 'cta_label']);
        });
    }
};
