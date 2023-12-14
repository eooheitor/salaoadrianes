<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;

class ClienteController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $clients = Client::where([
                ['nome', 'like', '%' . $search . '%']
            ])->get();
        } else {
            $clients = Client::orderBy('id', 'desc')->get();
        }
        return view('clientes.clientes', ['clients' => $clients, 'search' => $search]);
    }

    public function store(Request $request)
    {

        $messages = [
            'nome.required' => 'O campo nome é obrigatório',
            'cidade.required' => 'O campo cidade é obrigatório',
            'telefone.required' => 'O campo telefone é obrigatório',
            'cpf.required' => 'O campo cpf é obrigatório',
            'data.required' => 'O campo data é obrigatório',
        ];

        $request->validate([
            'nome' => 'required',
            'cidade' => 'required',
            'telefone' => 'required',
            'cpf' => 'required',
            'data' => 'required',
        ], $messages);

        $client = new Client;

        $client->nome = $request->nome;
        $client->cidade = $request->cidade;
        $client->telefone = $request->telefone;
        $client->cpf = $request->cpf;
        $client->data = $request->data;

        $client->save();

        // Recupere todos os clientes após salvar o novo cliente
        $client = Client::orderBy('id', 'desc')->get();

        return redirect('/clientes');
    }

    public function create()
    {
        return view('clientes.create')->with('msg', 'Cliente Adicionado com sucesso!');
    }

    public function destroy($id)
    {
        Client::findOrFail($id)->delete();
        return redirect('/clientes')->with('msg', 'Evento excluído!');
    }

    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clientes.edit', ['client' => $client]);
    }

    public function update(Request $request, $id)
    {

        $client = Client::findOrFail($id);

        $client->nome = $request->input('nome');
        $client->cidade = $request->input('cidade');
        $client->telefone = $request->input('telefone');
        $client->cpf = $request->input('cpf');
        $client->data = $request->input('data');

        $client->save();

        return redirect('/clientes');
    }
}
