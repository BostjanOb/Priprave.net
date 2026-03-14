<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. document_user pivot table
        Schema::create('document_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('document_id')->constrained()->cascadeOnDelete();
            $table->timestamp('created_at')->nullable();

            $table->primary(['user_id', 'document_id']);
        });

        // 2. download_daily_stats aggregates table
        Schema::create('download_daily_stats', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->unsignedInteger('download_count')->default(0);
        });

        // 3. downloads_count on users for pruning-safe badge checks
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('downloads_count')->default(0)->after('role');
        });

        // 4. Populate document_user from download_records
        DB::statement('
            INSERT INTO `document_user` (`user_id`, `document_id`, `created_at`)
            SELECT `user_id`, `document_id`, MIN(`created_at`)
            FROM `download_records`
            GROUP BY `user_id`, `document_id`
        ');

        // 5. Populate download_daily_stats from download_records
        DB::statement('
            INSERT INTO `download_daily_stats` (`date`, `download_count`)
            SELECT DATE(`created_at`), COUNT(*)
            FROM `download_records`
            GROUP BY DATE(`created_at`)
        ');

        // 6. Populate users.downloads_count from download_records
        if (in_array(DB::connection()->getDriverName(), ['mysql', 'mariadb'], true)) {
            DB::statement('
                UPDATE `users`
                INNER JOIN (
                    SELECT `user_id`, COUNT(*) AS `cnt`
                    FROM `download_records`
                    GROUP BY `user_id`
                ) AS `dr` ON `users`.`id` = `dr`.`user_id`
                SET `users`.`downloads_count` = `dr`.`cnt`
            ');
        } else {
            DB::statement('
                UPDATE `users`
                SET `downloads_count` = (
                    SELECT COUNT(*)
                    FROM `download_records`
                    WHERE `download_records`.`user_id` = `users`.`id`
                )
                WHERE EXISTS (
                    SELECT 1 FROM `download_records`
                    WHERE `download_records`.`user_id` = `users`.`id`
                )
            ');
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('downloads_count');
        });

        Schema::dropIfExists('download_daily_stats');
        Schema::dropIfExists('document_user');
    }
};
