<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
                'firstname' => 'CARLOS',
                'lastname'  => 'SIBAJA LOPEZ',
                'username'  => 'CASL',
                'email'     => 'contabilidad@coodescor.org.co',
                'area'      => 'administracion',
                'state'     => true,
        	]);

        factory(User::class)->create([
                'firstname' => 'KELLY',
                'lastname'  => 'PETRO HERNANDEZ',
                'username'  => 'KELLY',
                'email'     => 'aux_administrativa@coodescor.org.co',
                'area'      => 'administracion',
                'state'     => true,
            ]);

        factory(User::class)->create([
                'firstname' => 'STEFANIA',
                'lastname'  => 'BOLAÑOS PEREZ',
                'username'  => 'STEFANIA',
                'email'     => 'contabilidad2@coodescor.org.co',
                'area'      => 'administracion',
                'state'     => true,
            ]);        
    }
}
