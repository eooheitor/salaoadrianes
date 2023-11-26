<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Professional;

class ProfissionalController extends Controller
{
    public function index()
    {
        $search = request('search', ''); // Defina '' como valor padrão se não houver 'search' na requisição

        if ($search) {
            $profissionais = Professional::where([
                ['nome', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $profissionais = Professional::orderBy('id', 'desc')->get();
        }

        return view('profissionais.profissionais', ['profissionais' => $profissionais, 'search' => $search]);
    }

    public function store(Request $request)
    {
        $messages = [
            'nome.required' => 'O campo nome é obrigatório',
            'comissao.required' => 'O campo comissão é obrigatório',
        ];

        $request->validate([
            'nome' => 'required',
            'comissao' => 'required',
        ], $messages);

        $profissionais = new Professional;

        $profissionais->nome = $request->nome;
        $profissionais->comissao = $request->comissao;

        $profissionais->save();

        // Recupere todos os clientes após salvar o novo cliente
        $profissionais = Professional::orderBy('id', 'desc')->get();

        return redirect('/profissionais');
    }

    public function create()
    {
        return view('profissionais.create')->with('msg', 'Profissional Adicionado com sucesso!');
    }

    public function destroy($id)
    {
        Professional::findOrFail($id)->delete();
        return redirect('/profissionais')->with('msg', 'Evento excluído!');
    }

    public function edit($id)
    {
        $profissional = Professional::findOrFail($id);
        return view('profissionais.edit', ['profissional' => $profissional]);
    }

    public function update(Request $request, $id)
    {

        $profissionais = Professional::findOrFail($id);

        $profissionais->nome = $request->input('nome');
        $profissionais->comissao = $request->input('comissao');

        $profissionais->save();

        return redirect('/profissionais');
    }
}
