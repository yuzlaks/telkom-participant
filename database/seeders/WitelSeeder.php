<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WitelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('witels')->insert([
            [
                'witel' => 'DENPASAR', 
                'datel' => 'DENPASAR CENTRUM'
            ],
            [
                'witel' => 'DENPASAR', 
                'datel' => 'DENPASAR SELATAN'
            ],
            [
                'witel' => 'DENPASAR', 
                'datel' => 'DENPASAR UTARA'
            ],
            [
                'witel' => 'JEMBER', 
                'datel' => 'BANYUWANGI'
            ],
            [
                'witel' => 'JEMBER', 
                'datel' => 'JEMBER'
            ],
            [
                'witel' => 'JEMBER', 
                'datel' => 'SIBO'
            ],
            [
                'witel' => 'JEMBER', 
                'datel' => 'TANGGUL'
            ],
            [
                'witel' => 'KEDIRI', 
                'datel' => 'BLITAR'
            ],
            [
                'witel' => 'KEDIRI', 
                'datel' => 'KEDIRI'
            ],
            [
                'witel' => 'KEDIRI', 
                'datel' => 'NGANJUK'
            ],
            [
                'witel' => 'KEDIRI', 
                'datel' => 'TULUNG AGUNG'
            ],
            [
                'witel' => 'MADIUN', 
                'datel' => 'BOJONEGORO'
            ],
            [
                'witel' => 'MADIUN', 
                'datel' => 'MADIUN'
            ],
            [
                'witel' => 'MADIUN', 
                'datel' => 'NGAWI'
            ],
            [
                'witel' => 'MADIUN', 
                'datel' => 'PONOROGO'
            ],
            [
                'witel' => 'MADIUN', 
                'datel' => 'TUBAN'
            ],
            [
                'witel' => 'MADURA', 
                'datel' => 'BANGKALAN'
            ],
            [
                'witel' => 'MADURA', 
                'datel' => 'MADURA'
            ],
            [
                'witel' => 'MADURA', 
                'datel' => 'SUMENEP'
            ],
            [
                'witel' => 'MALANG', 
                'datel' => 'BATU'
            ],
            [
                'witel' => 'MALANG', 
                'datel' => 'KEPANJEN'
            ],
            [
                'witel' => 'MALANG', 
                'datel' => 'MALANG'
            ],
            [
                'witel' => 'NTB', 
                'datel' => 'BIMA'
            ],
            [
                'witel' => 'NTB', 
                'datel' => 'NTB'
            ],
            [
                'witel' => 'NTB', 
                'datel' => 'SUMBAWA'
            ],
            [
                'witel' => 'NTT', 
                'datel' => 'ATAMBUA'
            ],
            [
                'witel' => 'NTT', 
                'datel' => 'LABUHAN BAJO'
            ],
            [
                'witel' => 'NTT', 
                'datel' => 'MAUMERE'
            ],
            [
                'witel' => 'NTT', 
                'datel' => 'NTT'
            ],
            [
                'witel' => 'NTT', 
                'datel' => 'WAINGAPU'
            ],
            [
                'witel' => 'PASURUAN', 
                'datel' => 'LUMAJANG'
            ],
            [
                'witel' => 'PASURUAN', 
                'datel' => 'PASURUAN'
            ],
            [
                'witel' => 'PASURUAN', 
                'datel' => 'PROBOLINGGO'
            ],
            [
                'witel' => 'SIDOARJO', 
                'datel' => 'JOMBANG'
            ],
            [
                'witel' => 'SIDOARJO', 
                'datel' => 'MOJOKERTO'
            ],
            [
                'witel' => 'SIDOARJO', 
                'datel' => 'PANDAAN'
            ],
            [
                'witel' => 'SIDOARJO', 
                'datel' => 'SIDOARJO'
            ],
            [
                'witel' => 'SINGARAJA', 
                'datel' => 'GIANYAR'
            ],
            [
                'witel' => 'SINGARAJA', 
                'datel' => 'SINGARAJA'
            ],
            [
                'witel' => 'SINGARAJA', 
                'datel' => 'TABANAN'
            ],
            [
                'witel' => 'SURABAYA SELATAN', 
                'datel' => 'SURABAYA SELATAN'
            ],
            [
                'witel' => 'SURABAYA UTARA', 
                'datel' => 'GRESIK'
            ],
            [
                'witel' => 'SURABAYA UTARA', 
                'datel' => 'LAMONGAN'
            ],
            [
                'witel' => 'SURABAYA UTARA', 
                'datel' => 'SURABAYA UTARA'
            ],
        ]);
    }
}
