<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\BadgeService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

use function Laravel\Prompts\progress;

class SyncBadgesCommand extends Command
{
    protected $signature = 'badges:sync {--all : Sync all users, not just recently active}';

    protected $description = 'Sync badges for users based on their activity';

    public function handle(BadgeService $badgeService): int
    {
        progress(
            label: 'Syncing badges...',
            steps: User::unless(
                $this->option('all'),
                fn (Builder $query) => $query->where('last_login_at', '>=', now()->subDays(30))
            )->get(),
            callback: fn (User $user) => $badgeService->syncBadges($user),
            hint: 'This may take some time.'
        );

        return self::SUCCESS;
    }
}
