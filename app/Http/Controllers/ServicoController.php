<?php

namespace App\Http\Controllers;

use App\Models\Service;

use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
    {
        $search = request('search', ''); // Defina '' como valor padrão se não houver 'search' na requisição

        if ($search) {
            $servicos = Service::where([
                ['nome', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $servicos = Service::orderBy('id', 'desc')->get();
        }

        return view('servicos.servicos', ['servicos' => $servicos, 'search' => $search]);
    }

    public function store(Request $request)
    {

        $messages = [
            'nome.required' => 'O campo nome é obrigatório',
        ];

        $request->validate([
            'nome' => 'required',
        ], $messages);

        $servicos = new Service;

        $servicos->nome = $request->nome;

        $servicos->save();

        // Recupere todos os clientes após salvar o novo cliente
        $servicos = Service::orderBy('id', 'desc')->get();

        return redirect('/servicos');
    }

    public function create()
    {
        return view('servicos.create')->with('msg', 'Serviço Adicionado com sucesso!');
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return redirect('/servicos')->with('msg', 'Evento excluído');
    }

    public function edit($id)
    {
        $servico = Service::findOrFail($id);
        return view('servicos.edit', ['servico' => $servico]);
    }

    public function update(Request $request, $id)
    {

        $servicos = Service::findOrFail($id);

        $servicos->nome = $request->input('nome');
        $servicos->save();

        return redirect('/servicos');
    }
}
