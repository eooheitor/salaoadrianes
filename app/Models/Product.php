<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'produto';

    protected $dates = ['data'];


    public function vendaprodutos()
    {
        return $this->belongsToMany(VendaProduct::class, 'produto_vendaproduto', 'produto_id', 'venda_produto_id');
    }
}
