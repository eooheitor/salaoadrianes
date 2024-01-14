<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaProduct extends Model
{
    use HasFactory;

    protected $table = 'vendaproduto';

    public function cliente()
    {
        return $this->belongsTo(Client::class, 'cliente_id', 'id');
    }

    public function profissional()
    {
        return $this->belongsTo(Professional::class, 'profissional_id', 'id');
    }

    // Relação com a tabela produto_vendaproduto
    public function produtos()
    {
        return $this->hasMany(ProdutoVendaProduct::class, 'vendaproduto_id')->onDelete('cascade');
    }
}
