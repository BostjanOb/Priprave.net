<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DownloadDailyStat extends Model
{
    public $timestamps = false;

    protected function casts(): array
    {
        return [
            'download_count' => 'integer',
        ];
    }

    public static function incrementForToday(): void
    {
        $today = now()->toDateString();

        $affected = static::where('date', $today)->increment('download_count');

        if ($affected === 0) {
            static::insertOrIgnore([
                'date' => $today,
                'download_count' => 1,
            ]);
        }
    }
}
