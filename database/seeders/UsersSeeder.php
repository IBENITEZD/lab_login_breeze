<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1; $i <= 1; $i++) { // El bucle empieza en 1 y va hasta 20
            DB::table('users')->insert([
                'name' => 'Universidad', // Genera 'nombre 01', 'nombre 02', etc.
                'surname' => 'VIU' , // Genera 'apellido 01', 'apellido 02', etc.
                'DNI' => $this->generateDNI(), // Generación de DNI con 8 números y una letra
                'email' => 'seguridadweb@campusviu.es', // Email secuencial
                'password' => 'S3gur1d4d?W3b', // Contraseña encriptada
                'password_rep' => 'S3gur1d4d?W3b', // Repetición de la contraseña encriptada
                'telefono' => '+34' . rand(600000000, 699999999), // Teléfono aleatorio en formato español
                'pais' => $this->randomPais(), // Selección aleatoria entre Colombia, España, Alemania
                'sobre_ti' => Str::random(100), // Descripción aleatoria de 100 caracteres
                'email_verified_at' => now(), // Marca el email como verificado
                'remember_token' => Str::random(10), // Token aleatorio
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        };

        //
        for ($i = 2; $i <= 10; $i++) { // El bucle empieza en 1 y va hasta 20
            DB::table('users')->insert([
                'name' => 'name ' . str_pad($i, 2, '0', STR_PAD_LEFT), // Genera 'nombre 01', 'nombre 02', etc.
                'surname' => 'surname ' . str_pad($i, 2, '0', STR_PAD_LEFT), // Genera 'apellido 01', 'apellido 02', etc.
                'DNI' => $this->generateDNI(), // Generación de DNI con 8 números y una letra
                'email' => 'usuario' . str_pad($i, 2, '0', STR_PAD_LEFT) . '@example.com', // Email secuencial
                'password' => Hash::make(Str::random(10)), // Contraseña encriptada
                'password_rep' => Hash::make(Str::random(10)), // Repetición de la contraseña encriptada
                'telefono' => '+34' . rand(600000000, 699999999), // Teléfono aleatorio en formato español
                'pais' => $this->randomPais(), // Selección aleatoria entre Colombia, España, Alemania
                'sobre_ti' => Str::random(100), // Descripción aleatoria de 100 caracteres
                'email_verified_at' => now(), // Marca el email como verificado
                'remember_token' => Str::random(10), // Token aleatorio
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        };
    }

    /**
     * Generate a random DNI in the format of 8 digits followed by a letter.
     *
     * @return string
     */
    private function generateDNI()
    {
        $numbers = rand(1000000, 9999999); // Genera 8 números aleatorios
        $letter = chr(rand(65, 90)); // Genera una letra aleatoria (A-Z)

        return $numbers . $letter; // Combina los números y la letra
    }

    /**
     * Select a random country from a predefined list.
     *
     * @return string
     */
    private function randomPais()
    {
        $paises = ['Colombia', 'España', 'Alemania']; // Lista de países permitidos
        return $paises[array_rand($paises)]; // Selecciona aleatoriamente uno de los países
    }

}
