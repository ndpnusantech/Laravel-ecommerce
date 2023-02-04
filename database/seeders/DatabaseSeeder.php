<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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
        //     'name' => 'admin',
        //     'email' => 'admin@ecommerce.com',
        //     'password' => bcrypt('12345678'),
        //     'alamat' => '-',
        //     'status' => 'admin',
        // ]);

        for($no = 1; $no <=1000; $no++){
            DB::table('produks')->insert([
                'id_kategori' => '1',
                'nama_produk' => Str::random(10).'@ecommerce.com',
                'desk_produk' => Str::random(100),
                'jumlah' => '100',
                'diskon' => '100',
                'harga' => '100',
                'gambar' => '1675490272.jpg',
            ]);
        }
    }
}
