<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoVendaProduct extends Model
{
    protected $table = 'produto_vendaproduto'; // Nome da tabela intermediária

    protected $fillable = ['produto_id', 'vendaproduto_id', 'quantidade'];

    public function produto()
    {
        return $this->belongsTo(Product::class, 'produto_id');
    }

    public function vendaProduto()
    {
        return $this->belongsTo(VendaProduct::class, 'vendaproduto_id');
    }
}
