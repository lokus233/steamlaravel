<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PruebasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(app()->environment('local')){
            $editora_id = DB::table('editoras')->insertGetId([
                'nombre' => 'Steam',
            ]);

            $desarrolladora_id = DB::table('desarrolladoras')->insertGetId([
                'denominacion'=> 'Valve',
                'editora_id' => $editora_id,
            ]);

            DB::table('videojuegos')->insert([
                'nombre'=>'Inazuma Eleven',
                'precio'=>69.99,
                'lanzamiento' => Carbon::yesterday(),
                'desarrolladora_id' => $desarrolladora_id
            ]);

            DB::table('generos')->insert([
                ['genero' => 'Ciencia-ficción'],
                ['genero' => 'Terror'],
                ['genero' => 'Arcade'],
                ['genero' => 'Plataforma'],
                ['genero' => 'Lucha'],
                ['genero' => 'Lucha 3D'],
                ['genero' => 'VR'],
                ['genero' => 'Competitivo'],
                ['genero' => 'Puzzle'],
                ['genero' => 'Lógica'],
                ['genero' => 'Ajedrez'],
                ['genero' => 'Simulador'],
            ]);

            DB::table('hardware')->insert([
                ['nombre' => 'Steam Controller', 'descripcion' => '...', 'precio' => 80.00],
                ['nombre' => 'Steam Machine', 'descripcion' => '...', 'precio' => 70.00],
            ]);

            Db::table('genero_videojuego')->insert([]);
    }
    }
}
