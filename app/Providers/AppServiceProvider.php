<?php

namespace App\Providers;

use App\Auth\LegacyMd5UserProvider;
use App\Services\Browse\BrowseSearchService;
use App\Services\Browse\MeilisearchBrowseSearchService;
use App\Services\Documents\MeilisearchRelatedDocumentsSearchService;
use App\Services\Documents\RelatedDocumentsSearchService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;
use Meilisearch\Client;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Client::class, function (): Client {
            return new Client(
                config('scout.meilisearch.host'),
                config('scout.meilisearch.key')
            );
        });

        $this->app->bind(BrowseSearchService::class, MeilisearchBrowseSearchService::class);
        $this->app->bind(RelatedDocumentsSearchService::class, MeilisearchRelatedDocumentsSearchService::class);
    }

    public function boot(): void
    {
        Model::unguard();
        Number::useLocale('sl');
        Paginator::defaultView('pagination.default');
        Paginator::defaultSimpleView('pagination.simple');

        Auth::provider('legacy-eloquent', function ($app, array $config) {
            return new LegacyMd5UserProvider($app['hash'], $config['model']);
        });
    }
}
