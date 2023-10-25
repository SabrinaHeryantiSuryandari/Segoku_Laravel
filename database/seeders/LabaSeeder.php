<?php

namespace Database\Seeders;

use App\Models\LabaBulanan;
use App\Models\Prediksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $DataLaba = [
            [
                'bulan'=>'2022-11-3',
                'laba_bulanan'=>'10600000',
            ],
            [
                'bulan'=>'2022-12-3',
                'laba_bulanan'=>'11100000',
            ],
            [
                'bulan'=>'2023-01-3',
                'laba_bulanan'=>'9500000',
            ],
            [
                'bulan'=>'2023-02-3',
                'laba_bulanan'=>'10900000',
            ],
            [
                'bulan'=>'2023-03-3',
                'laba_bulanan'=>'10700000',
            ],
            [
                'bulan'=>'2023-04-3',
                'laba_bulanan'=>'12000000',
            ],
            [
                'bulan'=>'2023-05-3',
                'laba_bulanan'=>'11000000',
            ],
        ];
        foreach($DataLaba as $key => $laba){
            LabaBulanan::create($laba);
        }
    }
}
