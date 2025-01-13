<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Miembro;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Miembro>
 */
class MiembroFactory extends Factory
{
    public function definition(): array
    {
        $prefijosTelefono = ['0424', '0414', '0426', '0416', '0412'];
        $cargos = ['Desarrollador', 'Docente', 'Mantenimiento', 'Administración'];
        $generos = ['Masculino', 'Femenino'];

        return [
            'nombre_apellido' => fake()->name(),
            'cedula' => random_int(5000000, 45000000),
            'direccion' => fake()->address(),
            'telefono' => fake()->randomElement($prefijosTelefono) . fake()->numerify('#######'),
            'fecha_nacimiento' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'genero' => fake()->randomElement($generos),
            'email' => fake()->unique()->safeEmail(),
            'estado' => '1',
            'cargo_id' => \App\Models\Cargo::inRandomOrder()->first()->id,
            'foto' => '',
            'fecha_ingreso' => fake()->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
