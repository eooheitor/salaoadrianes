<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicoVendaService extends Model
{
    use HasFactory;

    protected $table = 'servico_vendaservico'; // Nome da tabela intermediária

    protected $fillable = ['servico_id', 'vendaservico_id'];

    public function servico()
    {
        return $this->belongsTo(Service::class, 'servico_id');
    }

    public function vendaServico()
    {
        return $this->belongsTo(VendaServico::class, 'vendaservico_id');
    }

}
