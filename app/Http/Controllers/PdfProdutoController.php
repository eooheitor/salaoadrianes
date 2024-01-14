<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendaProduct;
use App\Models\ProdutoVendaProduct;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfProdutoController extends Controller
{
    public function geraPDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $metodoPagamento = $request->input('metodopagamento');
        $profissional = $request->input('profissional');

        $query = VendaProduct::whereBetween('datavenda', [$startDate, $endDate]);

        if ($metodoPagamento) {
            $query->where('metodopagamento', $metodoPagamento);
        }

        if ($profissional) {
            $query->whereHas('profissional', function ($queryProfissional) use ($profissional) {
                $queryProfissional->where('nome', $profissional);
            });
        }

        $vendaprodutos = $query->get();

        $venda = ProdutoVendaProduct::with('produto')->get();

        // Inicialize um array para armazenar os produtos agrupados pelo vendaproduto_id
        $produtosAgrupados = [];

        foreach ($venda as $vendaProduto) {
            $vendaproduto_id = $vendaProduto->vendaproduto_id;
            $produtoNome = $vendaProduto->produto->nome;

            if (!isset($produtosAgrupados[$vendaproduto_id])) {
                $produtosAgrupados[$vendaproduto_id] = [
                    'vendaproduto_id' => $vendaproduto_id,
                    'produtos' => [],
                ];
            }

            $produtosAgrupados[$vendaproduto_id]['produtos'][] = $produtoNome;
        }

        $pdf = PDF::loadView('vendaprodutos.pdf', compact('vendaprodutos', 'produtosAgrupados')); // Passar como array

        return $pdf->setPaper('a4')->stream('Fechamento-mes.pdf');
    }
}
