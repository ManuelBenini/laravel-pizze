<?php

namespace App;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function pizzas(){
        return $this->belongsToMany('App\Pizza');
    }

    protected $fillable = [
        'nome',
        'slug',
    ];

    public static function generateSlug($nome){
        $slug = Str::slug($nome, '-');
        $base_slug = $slug;
        $slug_exist = Ingredient::where('slug', $slug)->first();
        $c = 1;

        while($slug_exist){
            $slug = $base_slug . '-' . $c;
            $c++;
            $slug_exist = Ingredient::where('slug', $slug)->first();
        }

        return $slug;
    }
}
