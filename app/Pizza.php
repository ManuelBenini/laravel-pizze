<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pizza extends Model
{
    protected $fillable = [
        'nome',
        'slug',
        'descrizione',
        'popolarita',
        'immagine',
        'prezzo',
        'vegetariana'
    ];

    public static function generateSlug($nome){
        $slug = Str::slug($nome, '-');
        $base_slug = $slug;
        $slug_exist = Pizza::where('slug', $slug)->first();
        $c = 1;

        while($slug_exist){
            $slug = $base_slug . '-' . $c;
            $c++;
            $slug_exist = Pizza::where('slug', $slug)->first();
        }

        return $slug;
    }
}
