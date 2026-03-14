<?php

namespace App\Observers;

use App\Models\DownloadRecord;
use App\Services\BadgeService;

class DownloadRecordObserver
{
    public function __construct(private readonly BadgeService $badgeService) {}

    public function created(DownloadRecord $downloadRecord): void
    {
        if ($downloadRecord->user) {
            $this->badgeService->checkDownloadBadges($downloadRecord->user);
        }

        $author = $downloadRecord->document?->user;
        if ($author) {
            $this->badgeService->checkNavdihBadge($author);
        }
    }
}
