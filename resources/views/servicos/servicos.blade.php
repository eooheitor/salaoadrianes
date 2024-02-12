@extends('header')

@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card mt-2">
                            <div class="card-body">
                                <h5 class="card-title">Tabela de Serviços</h5>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <div class="botao">
                                        <a href="/servicos/create"><button
                                                class="btn btn-primary btn-1">Cadastrar</button></a>
                                    </div>
                                    <form action="" method="GET">
                                        <input type="text" id="search" name="search" placeholder="Procure um Serviço"
                                            class="form-control mb-4">
                                        <!-- <button type="submit" class="btn btn-primary">Enviar</button> -->
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped text-left">
                                        <thead>
                                            @if (count($servicos) == 0 && $search)
                                                <h5 class="">Não há nenhum Serviço com o nome {{ $search }} <a
                                                        href="/servicos"><button class="btn btn-secondary">Ver
                                                            todos</button></a></h5>
                                            @elseif(count($servicos) == 0)
                                                <h2 class="">Não há Serviços cadastrados</h2>
                                            @else
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Serviço</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($servicos as $servico)
                                                <tr>
                                                    <td>

                                                        <button type="button" class="btn-icon" data-toggle="modal"
                                                            data-target="#modalExemplo-{{ $servico->id }}"><i class="bi bi-trash"></i></button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modalExemplo-{{ $servico->id }}" tabindex="-1"
                                                            role="dialog" aria-labelledby="exampleModalLabel-{{ $servico->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel-{{ $servico->id }}">
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
                                                                        <form action="/servicos/{{ $servico->id }}"
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
                                                        <a href="{{ route('servicos.edit', ['id' => $servico->id]) }}">
                                                            <button class="btn-icon2"><i
                                                                    class="bi bi-pencil-square"></i></button></a>
                                                    </td>
                                                    <th scope="row">{{ $servico->id }}</th>
                                                    <td>{{ $servico->nome }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @endif
                                    </table>
                                    {{-- <a href="/servicos/create"><button class="btn btn-primary btn-1">Cadastrar</button></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
