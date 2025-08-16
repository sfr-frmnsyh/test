<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use App\Models\MasterItem;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = Faker::create('id_ID');

        $suppliers = ['Tokopaedi', 'Bukulapuk', 'TokoBagas', 'E Commurz', 'Blublu'];
        $jenisList = ['Obat', 'Alkes', 'Matkes', 'Umum', 'ATK'];
        for ($i = 1; $i <= 50; $i++) {
            $kode = str_pad($i, 5, '0', STR_PAD_LEFT);
            MasterItem::create([
                'kode' => $kode,
                'nama' => ucfirst($faker->words(2, true)),
                'harga_beli' => rand(10, 50) * 1000,
                'laba' => rand(1, 6) * 5,
                'supplier' => $suppliers[array_rand($suppliers)],
                'jenis' => $jenisList[array_rand($jenisList)],
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            $kode = str_pad($i, 5, '0', STR_PAD_LEFT);
            Kategori::create([
                'kode' => $kode,
                'nama' => "Kategori " . $i,
            ]);
        }
    }
}
