<?php

namespace Database\Seeders;

use App\Models\Spk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdatePXRNameInSPK extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $spks = Spk::all();
        foreach ($spks as $spk) {
            if ($spk->reseller_id) {
                $spk->pxr_name = "$spk->reseller_nama - $spk->pelanggan_nama";
                $spk->save();
            }
        }
    }
}
