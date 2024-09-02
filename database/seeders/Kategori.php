<?php

namespace Database\Seeders;

use App\Models\KateFormsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Kategori extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        KateFormsModel::create([
            'kategori' => 'crane',
            'active' => '2', // active
        ]);
        KateFormsModel::create([
            'kategori' => 'forklift',
            'active' => '2', // active
        ]);
    }
}
