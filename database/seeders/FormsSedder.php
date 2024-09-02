<?php

namespace Database\Seeders;

use App\Models\FormsModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormsSedder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        FormsModel::create([
            'nama' => '10 Ton',
            'kategori' => '1',
            'active' => '1',//active
        ]);
        FormsModel::create([
            'nama' => '23 Tn',
            'kategori' => '1',
            'active' => '2',//active
        ]);
        FormsModel::create([
            'nama' => '30 ton',
            'kategori' => '2',
            'active' => '1',//active
        ]);
        FormsModel::create([
            'nama' => '20ton',
            'kategori' => '2',
            'active' => '2',//active
        ]);

        
    }
}
