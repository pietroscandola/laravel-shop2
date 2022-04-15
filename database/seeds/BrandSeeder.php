<?php

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
             ['name' => 'Adidas' , 'color' => 'primary'],
             ['name' => 'Nike' , 'color' => 'danger'],
             ['name' => 'Puma' , 'color' => 'dark'],
             ['name' => 'Fila' , 'color' => 'warning'],

        ];

        foreach($brands as $brand){
            $new_brand = new Brand();

            $new_brand->name = $brand['name'];
            $new_brand->color = $brand['color'];

            $new_brand->save();
        }
    }
}
