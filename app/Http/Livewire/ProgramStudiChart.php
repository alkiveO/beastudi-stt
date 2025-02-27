<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Mahasiswa;

class ProgramStudiChart extends Component
{
    public function render()
    {
        $years = range(2012, date('Y'));
        $data = [];

        foreach ($years as $year) {
            $data[$year]['sistem informasi'] = Mahasiswa::query()
                ->where('tahun_masuk', $year)
                ->where('program_studi', 'sistem informasi')
                ->count();

            $data[$year]['teknik informatika'] = Mahasiswa::query()
                ->where('tahun_masuk', $year)
                ->where('program_studi', 'teknik informatika')
                ->count();

            $data[$year]['bisnis digital'] = Mahasiswa::query()
                ->where('tahun_masuk', $year)
                ->where('program_studi', 'bisnis digital')
                ->count();
        }

        return view('livewire.program-studi-chart', [
            'data' => $data
        ]);
    }
}
