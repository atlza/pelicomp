<?php

namespace App\Providers;

use Generator;
use GuzzleHttp\Promise\Each;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use RuntimeException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Http::macro('concurrent',
            function (
                int $concurrency,
                callable $requests,
                callable $onFulfilled = null,
                callable $onRejected = null
            ): void {
                $requests = $requests(...)(new Pool());

                if (!$requests instanceof Generator) {
                    throw new RuntimeException(
                        '`Http::concurrent` requires a closure returning a Generator instance'
                    );
                }

                Each::ofLimit(
                    $requests,
                    $concurrency,
                    $onFulfilled,
                    $onRejected
                )->wait();

            }
        );
    }
}
