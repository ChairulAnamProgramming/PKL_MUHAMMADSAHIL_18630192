<?php

namespace Database\Factories;

use App\Models\filingOfMatter;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilingOfMatterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $default = [
            [
                'name' => 'Perceraian',
                'price' => '600000',
                'name_rek' => 'Bank Kalsel (BPD)',
                'rek' => '0000612345678',
                'description' => 'lorem ipsum'
            ],
            [
                'name' => 'Ahli Waris',
                'price' => '300000',
                'name_rek' => 'Bank Kalsel (BPD)',
                'rek' => '0000612345678',
                'description' => 'lorem ipsum'
            ],
            [
                'name' => 'Wasiat',
                'price' => '200000',
                'name_rek' => 'Bank Kalsel (BPD)',
                'rek' => '0000612345678',
                'description' => 'lorem ipsum'
            ],
            [
                'name' => 'Ekonomi Syariah',
                'price' => '100000',
                'name_rek' => 'Bank Kalsel (BPD)',
                'rek' => '0000612345678',
                'description' => 'lorem ipsum'
            ],
            [
                'name' => 'Wakaf',
                'price' => '250000',
                'name_rek' => 'Bank Kalsel (BPD)',
                'rek' => '0000612345678',
                'description' => 'lorem ipsum'
            ],
            [
                'name' => 'Infaq dan Sedeqah',
                'price' => '500000',
                'name_rek' => 'Bank Kalsel (BPD)',
                'rek' => '0000612345678',
                'description' => 'lorem ipsum'
            ],
        ];


        for ($i = 0; $i < count($default); $i++) {
            $filingOfMatter = filingOfMatter::create(
                [
                    'icon' => 'folder.png',
                    'name' => $default[$i]['name'],
                    'name_rek' => $default[$i]['name_rek'],
                    'rek' => $default[$i]['rek'],
                    'price' => $default[$i]['price'],
                    'description' => $default[$i]['description'],
                ]
            );
        }

        return $filingOfMatter;
    }
}
