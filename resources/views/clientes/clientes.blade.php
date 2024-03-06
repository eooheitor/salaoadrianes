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
                                <div class="col-md-12 d-flex justify-content-between">
                                    <div class="botao">
                                        <a href="/clientes/create"><button
                                                class="btn btn-primary btn-1">Cadastrar</button></a>
                                    </div>
                                    <form action="" method="GET">
                                        <input type="text" id="search" name="search" placeholder="Procure um cliente"
                                            class="form-control mb-4">
                                        <!-- <button type="submit" class="btn btn-primary">Enviar</button> -->
                                    </form>
                                </div>
                                @if ($search)
                                    <h5>Buscando por: {{ $search }}</h5>
                                @endif
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
                                                    <th scope="col">Data de nascimento</th>
                                                    <!-- <th scope="col">Data/Último Serviço </th> -->
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($clients as $client)
                                                <tr>
                                                    <td>

                                                        <button type="button" class="btn-icon" data-toggle="modal"
                                                            data-target="#modalExemplo-{{ $client->id }}"><i
                                                                class="bi bi-trash"></i></button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modalExemplo-{{ $client->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel-{{ $client->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel-{{ $client->id }}">
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
                                                    <td class="text-uppercase">{{ $client->nome }}</td>
                                                    <td class="text-uppercase">{{ $client->cidade }}</td>
                                                    <td class="text-uppercase">{{ $client->telefone }}</td>
                                                    <td class="text-uppercase">{{ $client->cpf }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($client->data)) }}</td>
                                                    <td>{{ date('d/m/Y', strtotime($client->datanascimento)) }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @endif
                                    </table>
                                    <?php
                                    if (!$search) {
                                        echo $clients->onEachSide(0)->links();
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection

<script>
    window.onload = () => {
        let myAlert = document.querySelector('.toast')
        let bsAlert = new bootstrap.Toast(myAlert);
        bsAlert.show();
    }
</script>
