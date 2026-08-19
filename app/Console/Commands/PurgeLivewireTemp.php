<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PurgeLivewireTemp extends Command
{
    protected $signature = 'beastudi:purge-livewire-temp {--older=24 : Hapus file temp Livewire yang lebih lama dari X jam}';

    protected $description = 'Membersihkan file upload sementara Livewire yang sudah terlantar';

    public function handle(): int
    {
        $dir = storage_path('app/livewire-tmp');

        if (! is_dir($dir)) {
            $this->info('Direktori livewire-tmp tidak ada.');

            return self::SUCCESS;
        }

        $olderHours = (int) $this->option('older');
        $cutoff = now()->subHours($olderHours)->getTimestamp();

        $removed = 0;
        $freed = 0;

        foreach (File::files($dir) as $file) {
            if ($file->getMTime() < $cutoff) {
                $freed += $file->getSize();
                File::delete($file->getPathname());
                $removed++;
            }
        }

        $this->info("Dihapus {$removed} file temp ({$this->humanBytes($freed)}).");

        return self::SUCCESS;
    }

    private function humanBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
