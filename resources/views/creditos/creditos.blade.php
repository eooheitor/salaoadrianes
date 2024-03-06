@extends('header')

@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card mt-2">
                            <div class="card-body">
                                <h5 class="card-title">Tabela de Créditos</h5>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <div class="botao">
                                        <a href="/creditos/create"><button
                                                class="btn btn-primary btn-1">Cadastrar</button></a>
                                    </div>
                                    <form action="" method="GET">
                                        <input type="text" id="search" name="search" placeholder="Procure um crédito"
                                            class="form-control mb-4">
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped text-left">
                                        <thead>
                                            @if (count($creditos) == 0 && $search)
                                                <h5 class="">Não há nenhum Crrédito com o nome {{ $search }} <a
                                                        href="/creditos"><button class="btn btn-secondary">Ver
                                                            todos</button></a></h5>
                                            @elseif(count($creditos) == 0)
                                                <h2 class="">Não há Créditos cadastrados</h2>
                                            @else
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Valor</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($creditos as $credito)
                                                <tr>
                                                    <td>

                                                        <button type="button" class="btn-icon" data-toggle="modal"
                                                            data-target="#modalExemplo-{{ $credito->id }}"><i
                                                                class="bi bi-trash"></i></button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modalExemplo-{{ $credito->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel-{{ $credito->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel-{{ $credito->id }}">
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
                                                                        <form action="/creditos/{{ $credito->id }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Excluir</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('creditos.edit', ['id' => $credito->id]) }}">
                                                            <button class="btn-icon2"><i
                                                                    class="bi bi-pencil-square"></i></button></a>
                                                    </td>
                                                    <th scope="row">{{ $credito->id }}</th>
                                                    <td class="text-uppercase">{{ $credito->nome }}</td>
                                                    <td>{{ $credito->valor }}</td>
                                                    <td class="text-uppercase">{{ $credito->status }}</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @endif
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
