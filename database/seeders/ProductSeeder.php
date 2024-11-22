<?php

namespace Database\Seeders;

use App\Models\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Smartphone XYZ Pro',
                'description' => 'Dernier modèle de smartphone avec 256GB de stockage et 8GB RAM',
                'price' => 2500000,
                'image_url' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=400&h=300&fit=crop',
                'stock' => 50,
            ],
            [
                'name' => 'Laptop UltraBook',
                'description' => 'Ordinateur portable léger avec processeur i7 et SSD 512GB',
                'price' => 8000000,
                'image_url' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?q=80&w=400&h=300&fit=crop',
                'stock' => 30,
            ],
            [
                'name' => 'Écouteurs Sans Fil Pro',
                'description' => 'Écouteurs bluetooth avec réduction de bruit active',
                'price' => 450000,
                'image_url' => 'https://images.unsplash.com/photo-1608156639585-b3a032ef9689?q=80&w=400&h=300&fit=crop',
                'stock' => 100,
            ],
            [
                'name' => 'Montre Connectée Sport',
                'description' => 'Montre intelligente avec GPS et moniteur cardiaque',
                'price' => 750000,
                'image_url' => 'https://images.unsplash.com/photo-1544117519-31a4b719223d?q=80&w=400&h=300&fit=crop',
                'stock' => 45,
            ],
            [
                'name' => 'Tablette HD Plus',
                'description' => 'Tablette 10 pouces avec écran 4K et stylet inclus',
                'price' => 3500000,
                'image_url' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?q=80&w=400&h=300&fit=crop',
                'stock' => 25,
            ],
            [
                'name' => 'Appareil Photo Pro',
                'description' => 'Appareil photo mirrorless 24MP avec objectif 18-55mm',
                'price' => 4500000,
                'image_url' => 'https://images.unsplash.com/photo-1502920917128-1aa500764cbd?q=80&w=400&h=300&fit=crop',
                'stock' => 15,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
