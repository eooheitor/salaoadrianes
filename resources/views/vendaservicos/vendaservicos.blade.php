@extends('header')

@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card mt-2">
                            <div class="card-body">
                                <h5 class="card-title">Tabela de Venda de Serviços</h5>
                                <div class="col-md-12 d-flex justify-content-between mb-4">
                                    <div class="botao">
                                        <a href="/vendaservicos/create"><button
                                                class="btn btn-primary btn-1">Cadastrar</button></a>
                                    </div>
                                    <form action="" method="GET" class="form-inline">
                                        <input type="date" id="search" name="search" placeholder=""
                                            class="form-control mr-2">
                                        <button class="btn btn-primary btn-1" type="submit">Filtrar</button>
                                    </form>
                                </div>
                                <?php if($search) { ?>
                                <div class="ml-3 mb-3">
                                    <a href="/vendaservicos"><button class="btn btn-primary btn-1">Limpar
                                            Filtro</button></a>
                                </div>
                                <?php } ?>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            @if (count($vendaservicos) == 0 && $search)
                                                <h5 class="">Não há nenhuma venda com o nome {{ $search }} <a
                                                        href="/vendaservicos"><button class="btn btn-secondary">Ver
                                                            todos</button></a></h5>
                                            @elseif(count($vendaservicos) == 0)
                                                <h2 class="">Não há venda cadastrada</h2>
                                            @else
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col"></th>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Serviço</th>
                                                    <th scope="col">Cliente</th>
                                                    <th scope="col">Profissional</th>
                                                    <th scope="col">Valor</th>
                                                    <th scope="col">Método Pagamento</th>
                                                    <th scope="col">Comissão</th>
                                                    <th scope="col">Valor Profissional</th>
                                                    <th scope="col">Data Venda</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($vendaservicos as $vendaservico)
                                                <tr>
                                                    <td>

                                                        <button type="button" class="btn-icon" data-toggle="modal"
                                                            data-target="#modalExemplo-{{ $vendaservico->id }}"><i
                                                                class="bi bi-trash"></i></button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modalExemplo-{{ $vendaservico->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel-{{ $vendaservico->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel-{{ $vendaservico->id }}">
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
                                                                        <form
                                                                            action="/vendaservicos/{{ $vendaservico->id }}"
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
                                                    </td>
                                                    <td><a
                                                            href="{{ route('vendaservicos.edit', ['id' => $vendaservico->id]) }}">
                                                            <button class="btn-icon2"><i
                                                                    class="bi bi-pencil-square"></i></button></a></td>
                                                    <th scope="row">{{ $vendaservico->id }}</th>
                                                    <td class="text-uppercase">
                                                        @foreach ($venda as $grupo)
                                                            @if ($grupo['vendaservico_id'] == $vendaservico->id)
                                                                {{ implode(', ', $grupo['servicos']) }}
                                                            @endif
                                                        @endforeach
                                                        {{-- Serviços --}}
                                                    </td>
                                                    <td class="text-uppercase">{{ $vendaservico->cliente->nome }}</td>
                                                    <td class="text-uppercase">{{ $vendaservico->profissional->nome }}</td>
                                                    <td class="">{{ $vendaservico->valor }}R$</td>
                                                    <td class="text-uppercase">{{ $vendaservico->metodopagamento }}</td>
                                                    <td class="">{{ $vendaservico->profissional->comissao }}%</td>
                                                    <?php
                                                    $porcentagem = ($vendaservico->valor * $vendaservico->profissional->comissao) / 100;
                                                    ?>
                                                    <td>{{ $porcentagem }}R$</td>
                                                    <td>{{ date('d/m/Y', strtotime($vendaservico->datavenda)) }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @endif
                                    </table>
                                    <div class="">
                                        <?php
                                        if (!$search) {
                                            echo $vendaservicos->onEachSide(0)->links();
                                        } ?>
                                    </div>
                                </div>


                                <form action="{{ route('generatePDF') }}" method="post" class="form-inline">
                                    @csrf
                                    <div class="row mt-5">
                                        <div class="col-lg-3">
                                            <label for="start_date">Data de início:</label>
                                            <input type="date" name="start_date" class="form-control">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="end_date">Data de fim:</label>
                                            <input type="date" name="end_date" class="form-control">
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="metodopagamento">Método de Pagamento:</label>
                                            <select class="form-control padding-select" name="metodopagamento">
                                                <option value="">Todos</option>
                                                <option value="Cartão">Cartão</option>
                                                <option value="Dinheiro">Dinheiro</option>
                                                <option value="Pix">Pix</option>
                                                <option value="Boleto">Boleto</option>
                                                <option value="Deve">Deve</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="profissional">Profissional:</label>
                                            <select class="form-control padding-select" name="profissional">
                                                <option value="">Todos</option>
                                                @foreach ($profissionais as $profissional)
                                                    <option value="{{ $profissional['nome'] }}">
                                                        {{ $profissional['nome'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-1 mt-4">Imprimir</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
