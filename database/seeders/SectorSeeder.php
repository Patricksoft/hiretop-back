<?php

namespace Database\Seeders;

use App\Models\Degree;
use App\Models\Sector;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tab = [
            "Technologie de l'information et des communications (TIC)",
            "Santé et services médicaux",
            "Finance et services bancaires",
            "Éducation et formation",
            "Commerce de détail et commerce électronique",
            "Fabrication et production",
            "Transport et logistique",
            "Services professionnels (consulting, services juridiques, services comptables, etc.)",
            "Tourisme et hospitalité",
            "Agriculture et agroalimentaire",
            "Énergie et services publics",
            "Médias et divertissement",
            "Immobilier et construction",
            "Automobile et transports",
            "Environnement et développement durable",
            "Services gouvernementaux et administration publique",
            "Sciences et recherche",
            "Industrie pharmaceutique et biotechnologie",
            "Arts et culture",
            "Sport et loisirs"

        ];

        foreach ($tab as $item) {
            Sector::updateOrCreate(
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
