<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
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

        /*
         * Aturan validasi dokumen PDF.
         *
         * Menerima file .pdf yang benar, termasuk PDF hasil scan yang kadang
         * terdeteksi MIME sebagai application/octet-stream (dan biasanya
         * ditolak oleh aturan bawaan mimes:pdf).
         *
         * - Ekstensi harus .pdf
         * - Jika isi file bisa dibaca, 5 byte pertama harus "%PDF-"
         * - File gambar (jpg/png/dll) ditolak dengan pesan yang jelas.
         */
        Validator::extend('pdf_file', function ($attribute, $value) {
            $path = null;
            $ext = null;

            if ($value instanceof \Illuminate\Http\UploadedFile) {
                $path = $value->getPathname();
                $ext = strtolower($value->getClientOriginalExtension());
            } elseif (is_object($value)) {
                if (method_exists($value, 'getClientOriginalExtension')) {
                    $ext = strtolower($value->getClientOriginalExtension());
                }
                if (method_exists($value, 'getPath')) {
                    $path = $value->getPath();
                } elseif (property_exists($value, 'path')) {
                    $path = $value->path;
                }
            } else {
                $path = (string) $value;
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            }

            if ($ext !== 'pdf') {
                return false;
            }

            // Jika isi file bisa dibaca, pastikan benar-benar PDF (%PDF-)
            if ($path && is_file($path)) {
                $handle = @fopen($path, 'rb');
                if ($handle) {
                    $head = fread($handle, 5);
                    fclose($handle);

                    return $head === '%PDF-';
                }
            }

            // Tidak bisa membaca isi (mis. temp Livewire) → andalkan ekstensi
            return true;
        });

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
