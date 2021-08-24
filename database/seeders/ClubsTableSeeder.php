<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Club;

class ClubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nama_club = ['SGM', 'JK', 'LLB', 'KK', 'MPRC', 'LBD', 'JRPC', 'PSP', 'SJY', 'MDRJ', 'ID', 'W', 'G'];

        for($i=0; $i<count($nama_club); $i++){
            Club::create([
                'nama_club' => $nama_club[$i],
                'city'      => '-',
                'no_center' => '-',
            ]);
        }
    }
}
