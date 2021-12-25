<?php

namespace Database\Factories;

use App\Models\People;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PeopleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = People::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::create([
            'name' => 'Admin Pengadilan Agama Negara',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);
        return [
            'user_id' => $user->id,
            'nik' => '1234567890',
            'address' => 'Alamat default',
            'place_of_birth' => 'Hulu Sungai Selatan',
            'date_of_birth' => date('Y-m-d'),
            'gender' => 'male',
            'phone' => '082217352617',
            'ktp' => 'default.png',
            'kk' => 'default.png',
        ];
    }
}
