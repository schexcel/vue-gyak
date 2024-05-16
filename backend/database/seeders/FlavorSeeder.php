<?php

namespace Database\Seeders;

use App\Models\Flavor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlavorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flavors = [
            ["Kóla", "Egyéb"],
            ["Vanília", "Egyéb"],
            ["Gyömbér", "Egyéb"],
            ["Citrom", "Gyümölcs"],
            ["Narancs", "Gyümölcs"],
            ["Szőlő", "Gyümölcs"],
            ["Cseresznye", "Gyümölcs"],
        ];

        foreach ($flavors as $flavor) {
            $f = new Flavor();
            $f->name = $flavor[0];
            $f->category = $flavor[1];
            $f->save();
        }
    }
}
