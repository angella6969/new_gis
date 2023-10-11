<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DaerahIrigasi;
use App\Models\map;
use App\Models\map_gis;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\map;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@yahoo.com',
            'password' => Hash::make('123456'),

        ]);

        map_gis::create([
            'xAx' =>  110.40877100158879,
            'yAx' => -7.781662717889876,
            'info' => 'ini adalah peta 1',
            // 'penerima_id' => '1',
        ]);
        map_gis::create([
            'xAx' =>  110.50877100158879,
            'yAx' => -7.781662717889876,
            'info' => 'ini adalah peta 6',
            // 'penerima_id' => '2',


        ]);
        map_gis::create([
            'xAx' =>  110.60877100158879,
            'yAx' => -7.781662717889876,
            'info' => 'ini adalah peta 5',
            // 'penerima_id' => '3',


        ]);
        map_gis::create([
            'xAx' =>  110.70877100158879,
            'yAx' => -7.781662717889876,
            'info' => 'ini adalah peta 4',
            // 'penerima_id' => '4',


        ]);
        map_gis::create([
            'xAx' =>  110.80877100158879,
            'yAx' => -7.781662717889876,
            'info' => 'ini adalah peta 3',
            // 'penerima_id' => '5',


        ]);
        map_gis::create([
            'xAx' =>  110.40877100158879,
            'yAx' => -7.881662717889876,
            'info' => 'ini adalah peta 2',
            // 'penerima_id' => '6',
        ]);
        DaerahIrigasi::create([
            'nama' => "Tajum"
        ]);
        DaerahIrigasi::create([
            'nama' => "Progo Manggis"
        ]);
        DaerahIrigasi::create([
            'nama' => "Mataram"
        ]);
        DaerahIrigasi::create([
            'nama' => "Kalibawang"
        ]);
        DaerahIrigasi::create([
            'nama' => "Kedungputri"
        ]);
        DaerahIrigasi::create([
            'nama' => "Boro"
        ]);
        DaerahIrigasi::create([
            'nama' => "Wadaslintang"
        ]);
        DaerahIrigasi::create([
            'nama' => "Banjarcahyana"
        ]);
        DaerahIrigasi::create([
            'nama' => "Tuk Kuning"
        ]);
        DaerahIrigasi::create([
            'nama' => "Singomerto"
        ]);
        DaerahIrigasi::create([
            'nama' => "Sempor"
        ]);
        DaerahIrigasi::create([
            'nama' => "Serayu"
        ]);
    }
}
