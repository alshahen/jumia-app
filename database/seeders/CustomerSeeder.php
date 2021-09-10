<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer')->insert([
            [
                'name' => 'Walid Hammadi',
                'phone' => '(212) 6007989253'
            ],
            [
                'name' => 'Yosaf Karrouch',
                'phone' => '(212) 698054317'
            ],
            [
                'name' => 'Tanvi Sachdeva',
                'phone' => '(258) 84330678235'
            ],
            [
                'name' => 'Filimon Embaye',
                'phone' => '(251) 914701723'
            ],
            [
                'name' => 'Ogwal David',
                'phone' => '(256) 7771031454'
            ],
            [
                'name' => 'ARREYMANYOR ROLAND TABOT',
                'phone' => '(237) 6A0311634'
            ],
            [
                'name' => 'SUGAR STARRK BARRAGAN',
                'phone' => '(237) 6780009592'
            ]
        ]);
    }
}
