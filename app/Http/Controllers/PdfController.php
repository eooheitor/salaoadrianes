<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendaService;
use App\Models\ServicoVendaService;
use Barryvdh\DomPDF\Facade\Pdf;


class PdfController extends Controller
{

  public function generatePDF(Request $request)
  {

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $metodoPagamento = $request->input('metodopagamento');
    $profissional = $request->input('profissional');

    $query = VendaService::whereBetween('datavenda', [$startDate, $endDate]);

    if ($metodoPagamento) {
      $query->where('metodopagamento', $metodoPagamento);
    }

    if ($profissional) {
      $query->whereHas('profissional', function ($queryProfissional) use ($profissional) {
        $queryProfissional->where('nome', $profissional);
      });
    }
    $vendaservicos = $query->get();

    $venda = ServicoVendaService::with('servico')->get();

    // Inicialize um array para armazenar os produtos agrupados pelo vendaproduto_id
    $servicosAgrupados = [];

    foreach ($venda as $vendaServico) {
      $vendaservico_id = $vendaServico->vendaservico_id;
      $servicoNome = $vendaServico->servico->nome;

      if (!isset($servicosAgrupados[$vendaservico_id])) {
        $servicosAgrupados[$vendaservico_id] = [
          'vendaservico_id' => $vendaservico_id,
          'servicos' => [],
        ];
      }

      $servicosAgrupados[$vendaservico_id]['servicos'][] = $servicoNome;
    }

    $pdf = PDF::loadView('vendaservicos.pdf', compact('vendaservicos', 'servicosAgrupados')); // Passar como array

    return $pdf->setPaper('a4')->stream('Fechamento-mes.pdf');
  }
}
