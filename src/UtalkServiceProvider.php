<?php

namespace Powertic\Utalk;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider;

/**
 * Class UtalkServiceProvider.
 */
class UtalkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->app->when(UtalkChannel::class)
            ->needs(Utalk::class)
            ->give(static function () {
                return new Utalk(
                    config('services.utalk.token')
                );
            });
    }
}
