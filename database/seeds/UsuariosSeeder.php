<?php

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=new Usuario();
        $admin->id_tipouser=1;
        $admin->nombre='Felipe';
        $admin->mail='feretama92@gmail.com';
        $admin->pass=Hash::make('admin');
        $admin->save();
    }
}
