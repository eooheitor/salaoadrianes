<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Product;
use App\Models\Professional;
use App\Models\ProdutoVendaProduct;
use App\Models\VendaProduct;

class VendaProductController extends Controller
{

    public function index()
    {
        $search = request('search', ''); // Defina '' como valor padrão se não houver 'search' na requisição

        if ($search) {
            $vendaprodutos = VendaProduct::where([
                ['nome', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $vendaprodutos = VendaProduct::orderBy('id', 'desc')->get();
        }

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

        return view('vendaprodutos.vendaprodutos', ['vendaprodutos' => $vendaprodutos, 'search' => $search, 'venda' => $produtosAgrupados]);
    }


    public function create()
    {
        $clientes = Client::all();
        $produtos = Product::all();
        $profissionais = Professional::all();

        return view('vendaprodutos.create', [
            'clientes' => $clientes,
            'produtos' => $produtos, // Adicione esta linha
            'profissionais' => $profissionais,
        ]);
    }


    public function store(Request $request)
    {

        $vendaprodutos = new VendaProduct;
        $vendaprodutos->cliente_id = $request->cliente_id;
        $vendaprodutos->profissional_id = $request->profissional_id;
        $vendaprodutos->valor = $request->valor;
        $vendaprodutos->metodopagamento = $request->metodopagamento;
        $vendaprodutos->tipopessoa = $request->tipopessoa;
        $vendaprodutos->datavenda = $request->datavenda;


        $vendaprodutos->save();

        $produtoIds = $request->input('produto_id', []);

        if (!empty($produtoIds)) {
            foreach ($produtoIds as $produtoId) {
                // $quantidade = 1; 
                $produtoVendaProduct = new ProdutoVendaProduct([
                    'produto_id' => $produtoId,
                    'vendaproduto_id' => $vendaprodutos->id,
                ]);
                $produtoVendaProduct->save();
            }
        }

        return redirect('/vendaprodutos')->with('success', 'Venda de produto registrada com sucesso!');
    }


    public function edit($id)
    {
        $vendaprodutos = VendaProduct::findOrFail($id);
        $clientes = Client::all();
        $profissionais = Professional::all();

        // Obtém os produtos associados à venda específica
        $produtosAssociados = ProdutoVendaProduct::where('vendaproduto_id', $vendaprodutos->id)->get();

        // Obtém todos os produtos disponíveis (se necessário)
        $produtosDisponiveis = Product::all();

        return view('vendaprodutos.edit', [
            'vendaprodutos' => $vendaprodutos,
            'clientes' => $clientes,
            'produtosAssociados' => $produtosAssociados, // Passa a lista de produtos associados para a view
            'profissionais' => $profissionais,
            'produtosDisponiveis' => $produtosDisponiveis, // Se desejar, você pode passar a lista de todos os produtos disponíveis
        ]);
    }


    public function update(Request $request, $id)
    {
        $vendaprodutos = VendaProduct::findOrFail($id);

        $vendaprodutos->cliente_id = $request->cliente_id;
        $vendaprodutos->profissional_id = $request->profissional_id;
        $vendaprodutos->valor = $request->valor;
        $vendaprodutos->metodopagamento = $request->metodopagamento;
        $vendaprodutos->tipopessoa = $request->tipopessoa;
        $vendaprodutos->datavenda = $request->datavenda;

        $vendaprodutos->save();

        // Produtos selecionados na edição
        $produtoIds = $request->input('produto_id', []);

        // Primeiro, remova todos os produtos associados a esta venda
        ProdutoVendaProduct::where('vendaproduto_id', $vendaprodutos->id)->delete();

        // Em seguida, adicione os produtos selecionados
        if (!empty($produtoIds)) {
            foreach ($produtoIds as $produtoId) {
                $produtoVendaProduct = new ProdutoVendaProduct([
                    'produto_id' => $produtoId,
                    'vendaproduto_id' => $vendaprodutos->id,
                ]);
                $produtoVendaProduct->save();
            }
        }

        return redirect('/vendaprodutos')->with('success', 'Venda de produto atualizada com sucesso!');
    }


    public function destroy($id)
    {
        VendaProduct::findOrFail($id)->delete();
        return redirect('/vendaprodutos')->with('msg', 'Evento excluído!');
    }
}