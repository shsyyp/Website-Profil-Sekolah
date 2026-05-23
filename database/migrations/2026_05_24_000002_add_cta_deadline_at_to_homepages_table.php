<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('homepages', 'cta_deadline_at')) {
            Schema::table('homepages', function (Blueprint $table) {
                $table->dateTime('cta_deadline_at')->nullable()->after('cta_deadline_label');
            });
        }

        DB::table('homepages')
            ->select('id', 'cta_countdown_days', 'cta_countdown_hours')
            ->whereNull('cta_deadline_at')
            ->orderBy('id')
            ->get()
            ->each(function ($homepage) {
                $days = max(0, (int) ($homepage->cta_countdown_days ?: 14));
                $hours = max(0, (int) ($homepage->cta_countdown_hours ?: 8));

                DB::table('homepages')
                    ->where('id', $homepage->id)
                    ->update([
                        'cta_deadline_at' => Carbon::now()->addDays($days)->addHours($hours),
                    ]);
            });
    }

    public function down(): void
    {
        if (Schema::hasColumn('homepages', 'cta_deadline_at')) {
            Schema::table('homepages', function (Blueprint $table) {
                $table->dropColumn('cta_deadline_at');
            });
        }
    }
};
