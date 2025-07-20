<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class ListWilayah extends Component
{
    public $village_id;
    public $village_name;

    public $province_id;
    public $regency_id;
    public $district_id;

    protected $rules = [
        'village_id' => 'required|string|max:10|unique:villages,id',
        'village_name' => 'required|string|max:50',
    ];

    protected $messages = [
        'village_id.required' => 'ID harus diisi',
        'village_id.unique' => 'ID sudah digunakan',
        'village_id.max' => 'ID max 10 karakter',
        'village_name.required' => 'Desa/Kelurahan harus diisi',
        'village_name.max' => 'Desa/Kelurahan max 50 karakter',
    ];

    public function updatedProvinceId()
    {
        $this->regency_id = null;
        $this->district_id = null;
    }

    public function updatedRegencyId()
    {
        $this->district_id = null;
    }

    public function store()
    {
        $this->validate();

        Village::create([
            'district_id' => $this->district_id,
            'id' => $this->village_id,
            'name' => $this->village_name,
        ]);

        $this->emit('alert', 'Berhasil', 'Wilayah berhasil ditambahkan', 'success');

        $this->emit('closeModalWilayah');

        $this->reset('village_id', 'village_name');
    }

    public function render()
    {
        return view('livewire.admin.list-wilayah', [
            'provinces' => Province::all(),
            'regencies' => $this->province_id ? Regency::where('province_id', $this->province_id)->get() : collect(),
            'districts' => $this->regency_id ? District::where('regency_id', $this->regency_id)->get() : collect(),
            'villages' => $this->province_id && $this->regency_id && $this->district_id
                ? Village::where('district_id', $this->district_id)->get()
                : collect(),
        ])->extends('layouts.app')->section('content');
    }
}

