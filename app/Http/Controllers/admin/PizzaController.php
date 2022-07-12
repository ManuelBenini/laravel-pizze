<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PizzaRequest;
use Illuminate\Http\Request;
use App\Pizza;
use App\Ingredient;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $base_query = $_GET['query'];
        if(!array_key_exists('query',$_GET)){
            $_GET['query'] = 'id';
        }

        $query = $_GET['query'];

        $pizze = Pizza::orderBy($query, 'asc')->paginate(10);

        return view('admin.pizzas.index', compact('pizze'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('admin.pizzas.create', compact('ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PizzaRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Pizza::generateSlug($data['nome']);

        $data['immagine'] = $this->imageUploader($request, $data);

        $new_pizza = new Pizza;
        $new_pizza->fill($data);
        $new_pizza->save();

        $new_pizza->ingredients()->attach($data['ingredients']);


        return redirect()->route('admin.pizzas.show', $new_pizza);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pizza $pizza)
    {
        $ingredients = Ingredient::all();
        return view('admin.pizzas.show', compact('pizza','ingredients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pizza $pizza)
    {
        $ingredients = Ingredient::all();
        return view('admin.pizzas.edit', compact('pizza','ingredients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PizzaRequest $request, Pizza $pizza)
    {
        $data = $request->all();

        if($data['nome'] != $pizza->nome){
            $data['slug'] = Pizza::generateSlug($data['nome']);
        }

        $data['immagine'] = $this->imageUploader($request, $data);

        $pizza->update($data);

        $pizza->ingredients()->sync($data['ingredients']);

        return redirect()->route('admin.pizzas.show', $pizza);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pizza $pizza)
    {
        $pizza->delete();

        return redirect()->route('admin.pizzas.index')->with('pizza_delete_success', "La pizza $pizza->nome è stata eliminata correttamente!");
    }

    public function imageUploader($request, $data){
        if($request->file('immagine')){

            $file = $request->file('immagine');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('image'), $filename);
            $data['immagine']= $filename;

            return $data['immagine'];
        }
    }
}
