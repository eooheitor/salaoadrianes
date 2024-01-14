<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product; // Use "Product" (singular)

class ProdutoController extends Controller
{

    public function RemoveVirgula($virg)
    {
        $virg = str_replace(",", ".", $virg);
        return $virg;
    }

    public function index()
    {
        $search = request('search', ''); // Defina '' como valor padrão se não houver 'search' na requisição

        if ($search) {
            $products = Product::where([
                ['nome', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $products = Product::orderBy('id', 'desc')->get();
        }

        return view('produtos.produtos', ['products' => $products, 'search' => $search]);
    }

    public function store(Request $request)
    {

        $messages = [
            'nome.required' => 'O campo nome é obrigatório',
            'quantidade.required' => 'O campo quantidade é obrigatório',
            'tamanho.required' => 'O campo tamanho é obrigatório',
            'valor.required' => 'O campo valor é obrigatório',
            'codproduto.required' => 'O campo codproduto é obrigatório',
            'datacompra.required' => 'O campo datacompra é obrigatório',
        ];

        $request->validate([
            'nome' => 'required',
            'quantidade' => 'required',
            'tamanho' => 'required',
            'valor' => 'required',
            'codproduto' => 'required',
            'datacompra' => 'required',
        ], $messages);

        $products = new Product;

        $products->nome = $request->nome;
        $products->quantidade = $request->quantidade;
        $products->tamanho = $request->tamanho;
        $products->valor = ProdutoController::RemoveVirgula($request->valor);
        $products->codproduto = $request->codproduto;
        $products->datacompra = $request->datacompra;

        $products->save();

        // Recupere todos os clientes após salvar o novo cliente
        $products = Product::orderBy('id', 'desc')->get();

        return redirect('/produtos');
    }

    public function create()
    {
        return view('produtos.create')->with('msg', 'Produto Adicionado com sucesso!');
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return redirect('/produtos')->with('msg', 'Evento excluído!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('produtos.edit', ['product' => $product]);
    }

    public function update(Request $request, $id)
    {

        $products = Product::findOrFail($id);

        $products->nome = $request->input('nome');
        $products->quantidade = $request->input('quantidade');
        $products->tamanho = $request->input('tamanho');
        $products->valor = ProdutoController::RemoveVirgula($request->input('valor'));
        $products->codproduto = $request->input('codproduto');
        $products->datacompra = $request->input('datacompra');

        $products->save();

        return redirect('/produtos');
    }
}
