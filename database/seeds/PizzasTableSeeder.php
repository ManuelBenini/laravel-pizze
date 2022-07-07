<?php

use App\Pizza;
use Illuminate\Database\Seeder;

class PizzasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizze = config('pizze');

        foreach ($pizze as $pizza) {
            $new_pizza = new Pizza;

            $new_pizza->nome = $pizza['nome'];
            $new_pizza->prezzo = $pizza['prezzo'];
            $new_pizza->descrizione = $pizza['ingredienti'];

            if($pizza['vegetariana'] == 'sì'){
                $pizza['vegetariana'] = true;
            }else{
                $pizza['vegetariana'] = false;
            }

            $new_pizza->vegetariana = $pizza['vegetariana'];
            $new_pizza->slug = Pizza::GenerateSlug($new_pizza->nome);
            $new_pizza->save();
        }
    }
}
