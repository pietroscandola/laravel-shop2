<?php

use App\Models\Brand;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Generator as Faker;


class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $brands = Brand::pluck('id')->toArray();
        for ($i = 0; $i < 15; $i++) {
            $new_product = new Product();
            $new_product->brand_id = rand(1, count($brands));
            $new_product->name = ucfirst($faker->word());
            $new_product->description = $faker->paragraph();
            $new_product->price = $faker->randomFloat(2, 1, 999);
            $new_product->image = $faker->imageUrl(200, 200);

            $new_product->save();
        }
    }
}
