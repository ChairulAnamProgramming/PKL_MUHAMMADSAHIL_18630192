<?php

namespace App\Actions\Fortify;

use App\Models\People;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'nik' => ['required', 'string', 'max:255', 'unique:peoples'],
            'place_of_birth' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255', 'in:male,female'],
            'phone' => ['required', 'string', 'max:255'],
            'ktp' => ['required'],
            'kk' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'role' => 'people',
            'password' => Hash::make($input['password']),
        ]);


        if (request()->file('ktp')) :
            $KTP = request()->file('ktp')->store('KTP', 'public');
        else :
            $KTP = 'default.png';
        endif;

        if (request()->file('kk')) :
            $KK = request()->file('kk')->store('KK', 'public');
        else :
            $KK = 'default.png';
        endif;

        $people =  People::create([
            'user_id' => $user->id,
            'nik' => $input['nik'],
            'address' => $input['address'],
            'place_of_birth' => $input['place_of_birth'],
            'date_of_birth' => $input['date_of_birth'],
            'gender' => $input['gender'],
            'phone' => $input['phone'],
            'ktp' => $KTP,
            'kk' => $KK,
        ]);

        if ($people) :
            return $user;
        endif;
    }
}
