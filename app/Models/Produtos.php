<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    //protected $table = 'produtos';
    protected $fillable = [
        'nome',
        'sobrenome',
        'descricao',
        'preco',
        'created_at',
        'updated_at'
    ];


    
}
