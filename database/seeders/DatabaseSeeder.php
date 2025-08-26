<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        // Create normal user
        User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'role' => 'normal',
        ]);

        // Create sample items (formes, articles, materials)
        $formes = [
            ['nom' => 'Oxford', 'type' => 'forme'],
            ['nom' => 'Derby', 'type' => 'forme'],
            ['nom' => 'Loafer', 'type' => 'forme'],
        ];

        foreach ($formes as $forme) {
            \App\Models\Item::create($forme);
        }

        // Create articles for each forme
        $articles = [
            ['nom' => 'Oxford Classic', 'type' => 'article', 'parent_id' => 1],
            ['nom' => 'Oxford Brogue', 'type' => 'article', 'parent_id' => 1],
            ['nom' => 'Derby Plain', 'type' => 'article', 'parent_id' => 2],
            ['nom' => 'Derby Wingtip', 'type' => 'article', 'parent_id' => 2],
            ['nom' => 'Penny Loafer', 'type' => 'article', 'parent_id' => 3],
        ];

        foreach ($articles as $article) {
            \App\Models\Item::create($article);
        }

        // Create materials
        $materials = [
            // Cuirs (Leathers)
            ['nom' => 'Cuir Noir', 'type' => 'cuir'],
            ['nom' => 'Cuir Marron', 'type' => 'cuir'],
            ['nom' => 'Cuir Cognac', 'type' => 'cuir'],
            
            // Semelles (Soles)
            ['nom' => 'Semelle Cuir', 'type' => 'semelle'],
            ['nom' => 'Semelle Gomme', 'type' => 'semelle'],
            ['nom' => 'Semelle Vibram', 'type' => 'semelle'],
            
            // Constructions
            ['nom' => 'Cousue Blake', 'type' => 'construction'],
            ['nom' => 'Cousue Goodyear', 'type' => 'construction'],
            ['nom' => 'Cousue Norvégienne', 'type' => 'construction'],
            
            // Supplements
            ['nom' => 'Patine Antique', 'type' => 'supplement'],
            ['nom' => 'Finition Brillante', 'type' => 'supplement'],
            ['nom' => 'Traitement Imperméable', 'type' => 'supplement'],
        ];

        foreach ($materials as $material) {
            \App\Models\Item::create($material);
        }

        // Create sample clients
        $clients = [
            [
                'nom' => 'Jean Dupont',
                'telephone' => '+33 1 23 45 67 89',
                'email' => 'jean.dupont@email.com',
                'adresse' => '123 Rue de la Paix',
                'ville' => 'Paris',
                'pays' => 'France'
            ],
            [
                'nom' => 'Marie Martin',
                'telephone' => '+33 2 34 56 78 90',
                'email' => 'marie.martin@email.com',
                'adresse' => '456 Avenue des Champs',
                'ville' => 'Lyon',
                'pays' => 'France'
            ],
        ];

        foreach ($clients as $client) {
            \App\Models\Client::create($client);
        }

        // Create sample orders
        $orders = [
            [
                'code' => 'CMD001',
                'firm' => 'Chaussures Élégantes',
                'ville' => 'Paris',
                'telephone' => '+33 1 23 45 67 89',
                'livraison' => now()->addDays(30),
                'transporteur' => 'DHL Express',
                'boite' => 'Boîte Standard',
                'notes' => 'Commande urgente pour client VIP',
                'transort' => 'Livraison express demandée',
            ],
            [
                'code' => 'CMD002',
                'firm' => 'Boutique Chaussures',
                'ville' => 'Lyon',
                'telephone' => '+33 2 34 56 78 90',
                'livraison' => now()->addDays(45),
                'transporteur' => 'Colissimo',
                'boite' => 'Boîte Premium',
                'notes' => 'Commande standard',
                'transort' => 'Livraison standard',
            ],
        ];

        foreach ($orders as $orderData) {
            $order = \App\Models\Order::create($orderData);
            
            // Add sample order lines
            \App\Models\OrderLine::create([
                'order_id' => $order->id,
                'article' => 'Oxford Classic',
                'forme' => 'Oxford',
                'client' => 'Jean Dupont',
                'semelle' => 'Semelle Cuir',
                'construction' => 'Cousue Blake',
                'cuir' => 'Cuir Noir',
                'supplement' => 'Patine Antique',
                'p7' => 2,
                'p8' => 5,
                'p9' => 3,
                'p10' => 2,
                'prix' => 350.00,
                'devise' => '€',
                'genre' => 'homme',
                'langue' => 'français',
            ]);
        }
    }
}
