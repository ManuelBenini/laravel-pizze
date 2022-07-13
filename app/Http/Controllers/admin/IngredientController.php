<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ingredient;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::orderBy('id','desc')->get();
        return view('admin.ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        # Variabile di sessione che conserva il nome inserito precedentemente
        session(['ingredient' => $data['nome']]);

        # Se l'ingrediente esiste, non è possibile inserirlo nuovamente nel database
        if(Ingredient::where('nome', $data['nome'])->first()){
            return redirect()->route('admin.ingredients.create')->with('ingredient_exist', 'L\'ingrediente esiste già');
        }

        $data['slug'] = Ingredient::generateSlug($data['nome']);

        $new_ingredient = new Ingredient;
        $new_ingredient->fill($data);
        $new_ingredient->save();

        return redirect()->route('admin.ingredients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        return view('admin.ingredients.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        return view('admin.ingredients.edit', compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $data = $request->all();

        # Variabile di sessione che conserva il nome inserito precedentemente
        session(['ingredient' => $data['nome']]);

        # Se l'ingrediente esiste, non è possibile inserirlo nuovamente nel database
        if(!($data['nome'] == $ingredient->nome)){

            if(Ingredient::where('nome', $data['nome'])->first()){
                return redirect()->route('admin.ingredients.edit', $ingredient)->with('ingredient_exist', 'L\'ingrediente esiste già');
            }
        }

        if($data['nome'] != $ingredient->nome){
            $data['slug'] = Ingredient::generateSlug($data['nome']);
        }

        $ingredient->update($data);

        return redirect()->route('admin.ingredients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('admin.ingredients.index')->with('ingredient_delete_success', "L'ingrediente $ingredient->nome è stato eliminato con successo");
    }
}
