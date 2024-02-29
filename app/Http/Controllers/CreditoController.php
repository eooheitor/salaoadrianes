<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use Illuminate\Http\Request;

class CreditoController extends Controller
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
            $creditos = Credit::where([
                ['nome', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $creditos = Credit::orderBy('id', 'desc')->get();
        }

        return view('creditos.creditos', ['creditos' => $creditos, 'search' => $search]);
    }

    public function store(Request $request)
    {

        $messages = [
            'nome.required' => 'O campo nome é obrigatório',
            'valor.required' => 'O campo Valor é obrigatório',
        ];

        $request->validate([
            'nome' => 'required',
            'valor' => 'required',
        ], $messages);

        $creditos = new Credit;

        $creditos->nome = $request->nome;
        $creditos->valor = $this->RemoveVirgula($request->valor);

        $creditos->save();

        $creditos = Credit::orderBy('id', 'desc')->get();

        return redirect('/creditos');
    }

    public function create()
    {
        return view('creditos.create')->with('msg', 'Serviço Adicionado com sucesso!');
    }

    public function destroy($id)
    {
        Credit::findOrFail($id)->delete();
        return redirect('/creditos')->with('msg', 'Evento excluído');
    }

    public function edit($id)
    {
        $credito = Credit::findOrFail($id);
        return view('creditos.edit', ['credito' => $credito]);
    }

    public function update(Request $request, $id)
    {

        $creditos = Credit::findOrFail($id);

        $creditos->nome = $request->input('nome');
        $creditos->valor = $this->RemoveVirgula($request->input('valor'));
        $creditos->save();

        return redirect('/creditos');
    }
}
