<?php

use Illuminate\Database\Seeder;
use App\Models\TipoUsuario;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole= new TipoUsuario;
        $adminRole->nombre='Admin';
        $adminRole->save();

        $userRole=new TipoUsuario;
        $userRole->name='Usuario';
        $userRole->save();
    }
}
