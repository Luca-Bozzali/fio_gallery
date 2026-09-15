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
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'phone')) {
                $table->dropColumn('phone');
            }

            if (Schema::hasColumn('settings', 'facebook_url')) {
                $table->dropColumn('facebook_url');
            }

            if (Schema::hasColumn('settings', 'website_url')) {
                $table->dropColumn('website_url');
            }

            if (Schema::hasColumn('settings', 'vimeo')) {
                $table->renameColumn('vimeo', 'vimeo_url');
            } elseif (! Schema::hasColumn('settings', 'vimeo_url')) {
                $table->string('vimeo_url')->nullable()->after('instagram_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            if (Schema::hasColumn('settings', 'vimeo_url')) {
                $table->renameColumn('vimeo_url', 'vimeo');
            }

            if (! Schema::hasColumn('settings', 'phone')) {
                $table->string('phone')->nullable();
            }

            if (! Schema::hasColumn('settings', 'facebook_url')) {
                $table->string('facebook_url')->nullable();
            }

            if (! Schema::hasColumn('settings', 'website_url')) {
                $table->string('website_url')->nullable();
            }
        });
    }
};