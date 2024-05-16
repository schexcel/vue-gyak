<?php

namespace Database\Seeders;

use App\Models\Drink;
use App\Models\Flavor;
use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrinkNIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drink = new Drink();
        $drink->name = "Cola";
        $drink->description = "Frissítő, kóla ízű üdítő!";
        $drink->quantity = 20;
        $drink->price = 800;
        $drink->discounted_price = 799;
        $drink->flavor_id = Flavor::where('name', 'Kóla')->first()->id;
        $drink->save();

        $ings = [
            'szénsavas víz',
            'kukoricaszirup',
            'foszforsav',
            'koffein',
        ];

        foreach ($ings as $ing) {
            $ingredient = new Ingredient();
            $ingredient->name = $ing;
            $ingredient->drink_id = $drink->id;
            $ingredient->save();
        }

        $drink = new Drink();
        $drink->name = "Lemonade";
        $drink->description = "Frissítő, cirtom ízű üdítő!";
        $drink->quantity = 15;
        $drink->price = 900;
        $drink->flavor_id = Flavor::where('name', 'Citrom')->first()->id;
        $drink->save();

        $ings = [
            'szénsavas víz',
            'citromlé',
            'cukor',
        ];

        foreach ($ings as $ing) {
            $ingredient = new Ingredient();
            $ingredient->name = $ing;
            $ingredient->drink_id = $drink->id;
            $ingredient->save();
        }


        $drink = new Drink();
        $drink->name = "Orange Soda";
        $drink->description = "Édes, narancs ízű üdítő!";
        $drink->quantity = 18;
        $drink->price = 850;
        $drink->flavor_id = Flavor::where('name', 'Narancs')->first()->id;
        $drink->save();

        $ings = [
            'szénsavas víz',
            'narancslé',
            'cukor',
        ];

        foreach ($ings as $ing) {
            $ingredient = new Ingredient();
            $ingredient->name = $ing;
            $ingredient->drink_id = $drink->id;
            $ingredient->save();
        }


    }
}
