@extends('header')

@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card mt-2">
                            <div class="card-body">
                                <h5 class="card-title">Tabela de Clientes</h5>
                                <div class="col-md-4">
                                    <form action="" method="GET">
                                        <input type="text" id="search" name="search" placeholder="Procure um cliente"
                                            class="form-control mb-4">
                                        <!-- <button type="submit" class="btn btn-primary">Enviar</button> -->
                                    </form>
                                </div>
                                @if ($search)
                                    <h5>Buscando por: {{ $search }}</h5>
                                @endif
                                <!-- @if (session('msg'))
    <p class="msg"> {{ session('msg') }} </p>
    @endif -->
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            @if (count($clients) == 0 && $search)
                                                <h5 class="">Não há nenhum cliente com o nome {{ $search }} <a
                                                        href="/clientes"><button class="btn btn-secondary">Ver
                                                            todos</button></a></h5>
                                            @elseif(count($clients) == 0)
                                                <h2 class="">Não há clientes cadastrados</h2>
                                            @else
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nome/Sobrenome</th>
                                                    <th scope="col">Cidade</th>
                                                    <th scope="col">Telefone</th>
                                                    <th scope="col">CPF</th>
                                                    <th scope="col">Data Último Serviço</th>
                                                    <!-- <th scope="col">Data/Último Serviço </th> -->
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clients as $client)
                                                <tr>
                                                    <td>

                                                        <button type="button" class="btn-icon" data-toggle="modal"
                                                            data-target="#modalExemplo"><i class="bi bi-trash"></i></button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modalExemplo" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Excluir <i class="bi bi-trash"></i> </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Fechar">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Tem certeza que deseja excluir? <br> Depois de
                                                                        excluído não terá como recuperar essa informação!
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Fechar</button>
                                                                        <form action="/clientes/{{ $client->id }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="btn btn-danger">Excluir</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('clientes.edit', ['id' => $client->id]) }}">
                                                            <button class="btn-icon2"><i
                                                                    class="bi bi-pencil-square"></i></button></a>
                                                    </td>

                                                    <th scope="row">{{ $client->id }}</th>
                                                    <td>{{ $client->nome }}</td>
                                                    <td>{{ $client->cidade }}</td>
                                                    <td>{{ $client->telefone }}</td>
                                                    <td>{{ $client->cpf }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($client->data)) }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @endif
                                    </table>
                                    <a href="/clientes/create"><button class="btn btn-primary btn-1">Cadastrar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
