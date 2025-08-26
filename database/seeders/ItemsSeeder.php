<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add sample cuirs data
        $cuirs = [
            ['code' => 'CU001', 'description' => 'Cuir de veau noir premium', 'price' => 85.00],
            ['code' => 'CU002', 'description' => 'Cuir de veau marron cognac', 'price' => 90.00],
            ['code' => 'CU003', 'description' => 'Cuir de veau bordeaux', 'price' => 88.00],
            ['code' => 'CU004', 'description' => 'Cuir de crocodile noir', 'price' => 450.00],
            ['code' => 'CU005', 'description' => 'Cuir de veau patiné à la main', 'price' => 120.00],
        ];

        foreach ($cuirs as $cuir) {
            Item::create([
                'nom' => $cuir['description'],
                'code' => $cuir['code'],
                'description' => $cuir['description'],
                'price' => $cuir['price'],
                'type' => 'cuir'
            ]);
        }

        // Add sample supplements data
        $supplements = [
            ['code' => 'SUP001', 'description' => 'Doublure en cuir de chèvre', 'price' => 25.00],
            ['code' => 'SUP002', 'description' => 'Embout renforcé en acier', 'price' => 15.00],
            ['code' => 'SUP003', 'description' => 'Talon en cuir empilé', 'price' => 35.00],
            ['code' => 'SUP004', 'description' => 'Lacets en cuir tressé', 'price' => 8.00],
            ['code' => 'SUP005', 'description' => 'Œillets en laiton poli', 'price' => 12.00],
        ];

        foreach ($supplements as $supplement) {
            Item::create([
                'nom' => $supplement['description'],
                'code' => $supplement['code'],
                'description' => $supplement['description'],
                'price' => $supplement['price'],
                'type' => 'supplement'
            ]);
        }

        // Add sample doublures data
        $doublures = [
            ['code' => 'DOU001', 'description' => 'Doublure en cuir de veau souple', 'price' => 20.00],
            ['code' => 'DOU002', 'description' => 'Doublure en tissu respirant', 'price' => 12.00],
            ['code' => 'DOU003', 'description' => 'Doublure en cuir de chèvre perforé', 'price' => 28.00],
            ['code' => 'DOU004', 'description' => 'Doublure antimicrobienne', 'price' => 18.00],
        ];

        foreach ($doublures as $doublure) {
            Item::create([
                'nom' => $doublure['description'],
                'code' => $doublure['code'],
                'description' => $doublure['description'],
                'price' => $doublure['price'],
                'type' => 'doublure'
            ]);
        }

        // Add sample semelles data
        $semelles = [
            ['code' => 'SEM001', 'description' => 'Semelle en cuir de première qualité', 'price' => 45.00],
            ['code' => 'SEM002', 'description' => 'Semelle en caoutchouc Vibram', 'price' => 55.00],
            ['code' => 'SEM003', 'description' => 'Semelle en liège naturel', 'price' => 38.00],
            ['code' => 'SEM004', 'description' => 'Semelle orthopédique sur mesure', 'price' => 85.00],
            ['code' => 'SEM005', 'description' => 'Semelle antidérapante', 'price' => 42.00],
        ];

        foreach ($semelles as $semelle) {
            Item::create([
                'nom' => $semelle['description'],
                'code' => $semelle['code'],
                'description' => $semelle['description'],
                'price' => $semelle['price'],
                'type' => 'semelle'
            ]);
        }

        // Add sample constructions data
        $constructions = [
            ['code' => 'CON001', 'description' => 'Construction Goodyear Welt', 'price' => 120.00],
            ['code' => 'CON002', 'description' => 'Construction Blake', 'price' => 85.00],
            ['code' => 'CON003', 'description' => 'Construction cousue main', 'price' => 200.00],
            ['code' => 'CON004', 'description' => 'Construction Norwegian Welt', 'price' => 150.00],
            ['code' => 'CON005', 'description' => 'Construction Bologna', 'price' => 95.00],
        ];

        foreach ($constructions as $construction) {
            Item::create([
                'nom' => $construction['description'],
                'code' => $construction['code'],
                'description' => $construction['description'],
                'price' => $construction['price'],
                'type' => 'construction'
            ]);
        }
    }
}
