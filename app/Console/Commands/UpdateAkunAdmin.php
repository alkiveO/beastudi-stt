<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UpdateAkunAdmin extends Command
{
    protected $signature = 'app:update-akun-admin';

    protected $description = 'update akun admin';

    public function handle()
    {
        $user = User::query()
            ->where('role', 'admin')
            ->update([
                'email' => 'beastudi@nurulfikri.ac.id',
                'password' => Hash::make('#PunyaBeastudiNF1#!')
            ]);
    }
}
