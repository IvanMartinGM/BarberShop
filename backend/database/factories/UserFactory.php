<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Usuario>
 */
class UserFactory extends Factory
{
    protected $model = Usuario::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombres' => fake()->firstName(),
            'primer_apellido' => fake()->lastName(),
            'segundo_apellido' => fake()->optional()->lastName(),
            'correo' => fake()->unique()->safeEmail(),
            'contrasena' => static::$password ??= Hash::make('password'),
            'estado' => true,
            'nombre_usuario' => fake()->unique()->userName(),
            'fecha_registro' => now(),
            'ultimo_acceso' => now(),
            'genero' => fake()->randomElement(['M', 'F', 'otro']),
            'foto_perfil' => fake()->optional()->imageUrl(),
            'celular' => fake()->optional()->phoneNumber(),
        ];
    }
}
