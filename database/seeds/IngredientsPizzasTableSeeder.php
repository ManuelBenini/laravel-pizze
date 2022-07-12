<?php

use Illuminate\Database\Seeder;
use App\Pizza;
use App\Ingredient;

class IngredientsPizzasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizzas = Pizza::all();

        foreach($pizzas as $pizza){

            if(count($pizza->ingredients) == 0){
                $ingredient_id = Ingredient::inRandomOrder()->take(rand(1 , 4))->select('id')->get();
                foreach ($ingredient_id as $ingredient) {
                    $pizza->ingredients()->attach($ingredient->id);
                }
            }
        }
    }
}
