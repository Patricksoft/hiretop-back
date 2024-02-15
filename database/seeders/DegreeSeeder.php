<?php

namespace Database\Seeders;

use App\Models\Degree;
use App\Models\IntervalWeight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tab = [
            "Baccalauréat (Bac)",
            "Licence",
            "Master",
            "Doctorat (Ph.D.)",
            "Diplôme d'études secondaires (DES)",
            "Diplôme d'études collégiales (DEC)",
            "Diplôme universitaire de technologie (DUT)",
            "Diplôme d'ingénieur",
            "Certificat professionnel",
            "Certificat de qualification professionnelle (CQP)",
            "Certificat d'aptitude professionnelle (CAP)",
            "Brevet de technicien supérieur (BTS)",
            "Brevet professionnel (BP)",
            "Diplôme d'études supérieures spécialisées (DESS)",
            "Mastère spécialisé"
        ];

        foreach ($tab as $item) {
            Degree::updateOrCreate(
                [
                    'name' => $item
                ],
                [
                    'name' => $item
                ],
            );

        }
    }
}
