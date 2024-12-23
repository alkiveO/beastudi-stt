<?php

namespace App\Http\Livewire\Admin;

use App\Exports\ExportMonitoring;
use App\Models\Periode;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class DownloadMonitoring extends Component
{
    public $periode_id;

    public function download()
    {
        $periode = Periode::find($this->periode_id);

        $filename = 'Monitoring Beastudi Periode ' . $periode->slug . '.xlsx';

        return Excel::download(new ExportMonitoring($this->periode_id), $filename);
    }

    public function render()
    {
        return view('livewire.admin.download-monitoring', [
            'list_periode' => Periode::all(),
        ]);
    }
}
