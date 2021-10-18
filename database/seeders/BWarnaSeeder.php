<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\BWarna;

class BWarnaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kode = ['BB', 'BBPD', 'BC', 'VA', 'W', 'SL', 'RC', 'BCWP', 'ZK', 'D', 'GZ', 'BP', 'RED'];
        $warna = ['Megan', 'Megan Selap', 'Tritis', 'Pal', 'Putih', 'Slate', 'Tritis Merah', 'Tritis Slap', 'Tritis Gelap', 'Hitam', 'rizzle', 'Megan Slap', 'Merah'];

        for($i=0; $i<count($warna); $i++){
            BWarna::create([
                'kode_warna' => $kode[$i],
                'warna' => $warna[$i],
            ]);
        }
    }
}
