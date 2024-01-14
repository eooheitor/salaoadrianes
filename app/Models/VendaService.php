<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaService extends Model
{
    use HasFactory;

    protected $table = 'vendaservico';

    public function cliente()
    {
        return $this->belongsTo(Client::class, 'cliente_id', 'id');
    }

    public function profissional()
    {
        return $this->belongsTo(Professional::class, 'profissional_id', 'id');
    }

    public function servicos()
    {
        return $this->hasMany(ServicoVendaService::class, 'vendaservico_id')->onDelete('cascade');
    }
    
}
