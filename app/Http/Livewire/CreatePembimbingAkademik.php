<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Admin\ListPembimbingAkademik;
use App\Models\PembimbingAkademik;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreatePembimbingAkademik extends Component
{
    public $program_studi;
    public $nama;
    public $email;
    public $password;

    public function rules()
    {
        return [
            'program_studi' => ['required'],
            'nama' => [
                'required',
                function ($attribute, $value, $fail) {
                    $exists = PembimbingAkademik::query()
                        ->where('program_studi', $this->program_studi)
                        ->where('nama', $value)
                        ->exists();

                    if ($exists) {
                        $fail('Dosen ini sudah menjadi PA untuk program studi tersebut.');
                    }
                },
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'password' => [
                'required',
                'string',
                'min:8',
            ],
        ];
    }

    protected $messages = [
        'program_studi.required' => 'Program Studi harus diisi.',
        'nama.required' => 'Nama Dosen harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password harus diisi.',
        'password.min' => 'Password minimal 8 karakter.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validated = $this->validate();

        DB::transaction(function () use ($validated) {
            $pembimbing = PembimbingAkademik::create([
                'nama' => $validated['nama'],
                'program_studi' => $validated['program_studi'],
            ]);

            User::create([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'pa',
                'pembimbing_akademik_id' => $pembimbing->id,
            ]);
        });

        $this->emit(
            'alert',
            'Berhasil',
            'Data Pembimbing Akademik dan akun PA berhasil ditambahkan.',
            'success'
        );

        $this->emitTo(ListPembimbingAkademik::class, 'refreshPage');

        $this->reset([
            'program_studi',
            'nama',
            'email',
            'password',
        ]);

        $this->emit('closeModal');
    }

    public function render()
    {
        return view('livewire.create-pembimbing-akademik');
    }
}