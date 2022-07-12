<?php

use Illuminate\Database\Seeder;
use App\Pizza;
use App\Ingredient;

class PizzasIngredientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizzas = Pizza::all();
        // $count = count($pizzas) * 3;

        // for($i = 0; $i < $count; $i++){

        //     $pizza = Pizza::inRandomOrder()->first();
        //     $ingredient_id = Ingredient::inRandomOrder()->first()->id;

        //     if(!$pizza->ingredients->contains($ingredient_id)){
        //         $pizza->ingredients()->attach($ingredient_id);
        //     }
        // }

        // foreach($pizzas as $pizza){
        //     if(!$pizza->ingredients){
        //         $ingredient_id = Ingredient::inRandomOrder()->first()->id;
        //         $pizza->ingredients()->attach($ingredient_id);
        //     }
        // }

        foreach($pizzas as $pizza){

            if(count($pizza->ingredients) == 0){
                $ingredient_id = Ingredient::inRandomOrder()->take(rand(1 , 4))->select('id')->get();
                foreach ($ingredient_id as $ingredient) {
                    $pizza->ingredients()->attach($ingredient->id);
                }
            }
        }


        // dd($ingredient_id = Ingredient::inRandomOrder()->first()->id);
        // dump($ingredient_id = Ingredient::inRandomOrder()->take(rand(1 , 4))->select('id')->get());
    }
}
