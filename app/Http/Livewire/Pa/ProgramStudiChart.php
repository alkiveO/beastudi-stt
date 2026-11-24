<?php

namespace App\Http\Livewire\Pa;

use Livewire\Component;
use App\Models\Mahasiswa;

class ProgramStudiChart extends Component
{
    public function render()
    {
        $paId = auth()->user()->pembimbing_akademik_id;

        $years = range(2012, date('Y'));
        $data = [];

        foreach ($years as $year) {
            $data[$year]['sistem informasi'] = Mahasiswa::query()
                ->where('pembimbing_akademik_id', $paId)
                ->where('tahun_masuk', $year)
                ->where('program_studi', 'sistem informasi')
                ->count();

            $data[$year]['teknik informatika'] = Mahasiswa::query()
                ->where('pembimbing_akademik_id', $paId)
                ->where('tahun_masuk', $year)
                ->where('program_studi', 'teknik informatika')
                ->count();

            $data[$year]['bisnis digital'] = Mahasiswa::query()
                ->where('pembimbing_akademik_id', $paId)
                ->where('tahun_masuk', $year)
                ->where('program_studi', 'bisnis digital')
                ->count();
        }

        return view('livewire.program-studi-chart', [
            'data' => $data,
        ]);
    }
}