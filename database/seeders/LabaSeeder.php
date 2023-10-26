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
                'bulan'=>'2022-11',
                'laba_bulanan'=>'2000000',
            ],
            [
                'bulan'=>'2022-12',
                'laba_bulanan'=>'3756000',
            ],
            [
                'bulan'=>'2023-01',
                'laba_bulanan'=>'2960000',
            ],
            [
                'bulan'=>'2023-02',
                'laba_bulanan'=>'2248000',
            ],
            [
                'bulan'=>'2023-03',
                'laba_bulanan'=>'2740000',
            ],
            [
                'bulan'=>'2023-04',
                'laba_bulanan'=>'2584000',
            ],
            [
                'bulan'=>'2023-05',
                'laba_bulanan'=>'2508000',
            ],
        ];
        foreach($DataLaba as $key => $laba){
            LabaBulanan::create($laba);
        }
    }
}
