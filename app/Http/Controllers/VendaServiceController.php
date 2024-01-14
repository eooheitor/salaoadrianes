<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Service;
use App\Models\Professional;
use App\Models\ServicoVendaService;
use App\Models\VendaService;

class VendaServiceController extends Controller
{

    public function RemoveVirgula($virg)
    {
        $virg = str_replace(",", ".", $virg);
        return $virg;
    }

    public function index()
    {
        $search = request('search', '');

        if ($search) {
            $vendaservicos = VendaService::where([
                ['datavenda', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $vendaservicos = VendaService::orderBy('id', 'desc')->get();
        }

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

        $profissionais = Professional::all();

        return view('vendaservicos.vendaservicos', ['vendaservicos' => $vendaservicos, 'search' => $search, 'profissionais' => $profissionais, 'venda' => $servicosAgrupados]);
        // return view('vendaservicos.vendaservicos', ['vendaservicos' => $vendaservicos]);
    }

    public function create()
    {
        $clientes = Client::all();
        $servicos = Service::all();
        $profissionais = Professional::all();

        return view('vendaservicos.create', [
            'clientes' => $clientes,
            'servicos' => $servicos, // Adicione esta linha
            'profissionais' => $profissionais,
        ]);
    }

    public function store(Request $request)
    {

        $vendaservicos = new VendaService;
        $vendaservicos->cliente_id = $request->cliente_id;
        $vendaservicos->profissional_id = $request->profissional_id;
        $vendaservicos->valor = VendaServiceController::RemoveVirgula($request->valor);
        $vendaservicos->metodopagamento = $request->metodopagamento;
        $vendaservicos->datavenda = $request->datavenda;


        $vendaservicos->save();

        $servicoIds = $request->input('servico_id', []);

        if (!empty($servicoIds)) {
            foreach ($servicoIds as $servicoId) {
                // $quantidade = 1; 
                $servicoVendaProduct = new ServicoVendaService([
                    'servico_id' => $servicoId,
                    'vendaservico_id' => $vendaservicos->id,
                ]);
                $servicoVendaProduct->save();
            }
        }

        return redirect('/vendaservicos')->with('success', 'Venda de serviço registrada com sucesso!');
    }

    public function edit($id)
    {
        $vendaservicos = VendaService::findOrFail($id);
        $clientes = Client::all();
        $profissionais = Professional::all();

        // Obtém os produtos associados à venda específica
        $servicosAssociados = ServicoVendaService::where('vendaservico_id', $vendaservicos->id)->get();

        // Obtém todos os produtos disponíveis (se necessário)
        $servicosDisponiveis = Service::all();

        return view('vendaservicos.edit', [
            'vendaservicos' => $vendaservicos,
            'clientes' => $clientes,
            'servicosAssociados' => $servicosAssociados, // Passa a lista de produtos associados para a view
            'profissionais' => $profissionais,
            'servicosDisponiveis' => $servicosDisponiveis, // Se desejar, você pode passar a lista de todos os produtos disponíveis
        ]);
    }

    public function update(Request $request, $id)
    {
        $vendaservicos = VendaService::findOrFail($id);

        $vendaservicos->cliente_id = $request->cliente_id;
        $vendaservicos->profissional_id = $request->profissional_id;
        $vendaservicos->valor = VendaServiceController::RemoveVirgula($request->valor);
        $vendaservicos->metodopagamento = $request->metodopagamento;
        $vendaservicos->datavenda = $request->datavenda;

        $vendaservicos->save();

        // Produtos selecionados na edição
        $servicoIds = $request->input('servico_id', []);

        // Primeiro, remova todos os produtos associados a esta venda
        ServicoVendaService::where('vendaservico_id', $vendaservicos->id)->delete();

        // Em seguida, adicione os produtos selecionados
        if (!empty($servicoIds)) {
            foreach ($servicoIds as $servicoId) {
                $servicoVendaService = new ServicoVendaService([
                    'servico_id' => $servicoId,
                    'vendaservico_id' => $vendaservicos->id,
                ]);
                $servicoVendaService->save();
            }
        }

        return redirect('/vendaservicos')->with('success', 'Venda de serviço atualizada com sucesso!');
    }

    public function destroy($id)
    {
        VendaService::findOrFail($id)->delete();
        return redirect('/vendaservicos')->with('msg', 'Evento excluído!');
    }
}
