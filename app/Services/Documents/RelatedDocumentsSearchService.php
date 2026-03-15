<?php

namespace App\Services\Documents;

use App\Models\Document;
use Illuminate\Support\Collection;

interface RelatedDocumentsSearchService
{
    /**
     * @return Collection<int, Document>
     */
    public function search(Document $document, int $limit = 3): Collection;
}
