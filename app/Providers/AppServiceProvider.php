<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Str::macro('linkify', function ($text) {
            $pattern = '/((https?:\/\/)?(www\.)?[a-z0-9\-\.]+\.[a-z]{2,}\/?[^\s]*)/i';

            return preg_replace_callback($pattern, function ($matches) {
                $url = $matches[0];

                // Tambahkan https:// jika tidak ada
                $href = preg_match('/^https?:\/\//', $url) ? $url : 'https://' . $url;

                return '<a href="' . $href . '" target="_blank" rel="noopener noreferrer">' . $url . '</a>';
            }, $text);
        });
    }
}
