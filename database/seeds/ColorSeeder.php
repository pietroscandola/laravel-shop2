<?php

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = ['Rosso', 'Nero', 'Giallo', 'Blu', 'Verde'];

        foreach ($colors as $color) {
            $new_color = new Color();

            $new_color->color = $color;

            $new_color->save();
        }
    }
}
