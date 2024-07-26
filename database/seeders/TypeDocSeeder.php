<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeDocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sunat_typedoc')->insert([
            ['id_doc' => '0', 'name_doc' => 'OTRO DOCUMENTO (COD 0)', 'description_doc' => 'DOC.TRIB.NO.DOM.SIN.RUC'],
            ['id_doc' => '1', 'name_doc' => 'D.N.I.', 'description_doc' => 'DOC. NACIONAL DE IDENTIDAD'],
            ['id_doc' => '4', 'name_doc' => 'CARNET DE EXTRANJERIA (COD 4)', 'description_doc' => 'CARNET DE EXTRANJERIA'],
            ['id_doc' => '6', 'name_doc' => 'R.U.C.', 'description_doc' => 'REG. UNICO DE CONTRIBUYENTES'],
            ['id_doc' => '7', 'name_doc' => 'PASAPORTE (COD 7)', 'description_doc' => 'PASAPORTE'],
            ['id_doc' => 'A', 'name_doc' => 'CED. DIPLOMATICA DE IDENTIDAD (COD A)', 'description_doc' => 'CED. DIPLOMATICA DE IDENTIDAD'],
            ['id_doc' => 'B', 'name_doc' => 'OC.IDENT.PAIS.RESIDENCIA-NO.D (COD B)', 'description_doc' => 'DOC.IDENT.PAIS.RESIDENCIA-NO.D'],
            ['id_doc' => 'C', 'name_doc' => 'TIN (COD C)', 'description_doc' => 'Tax Identification Number - TIN – Doc Trib PP.NN'],
            ['id_doc' => 'D', 'name_doc' => 'IN (COD D)', 'description_doc' => 'Identification Number - IN – Doc Trib PP. JJ'],
        ]);
    }
}
