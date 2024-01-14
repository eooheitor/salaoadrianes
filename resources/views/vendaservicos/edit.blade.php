@extends('header')

@section('content')
    <main id="main" class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-1">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Editar Venda de Serviço</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{ route('vendaservicos.update', ['id' => $vendaservicos->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="col-12">
                                    <label for="" class="form-label">Serviços</label>
                                    <select name="servico_id[]" class="form-control select2-single" multiple>
                                        @foreach ($servicosDisponiveis as $servico)
                                            <option value="{{ $servico->id }}"
                                                @if ($servicosAssociados->contains('servico_id', $servico->id)) selected @endif>
                                                {{ $servico->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>




                                <div class="col-12">
                                    <label for="" class="form-label">Cliente</label>
                                    <select class="select2 form-control" name="cliente_id">
                                        <option value="">Selecione</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}"
                                                {{ $cliente->id == $vendaservicos->cliente_id ? 'selected' : '' }}>
                                                {{ $cliente->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Profissional</label>
                                    <select class="select2 form-control" name="profissional_id">
                                        <option value="">Selecione</option>
                                        @foreach ($profissionais as $profissional)
                                            <option value="{{ $profissional->id }}"
                                                {{ $profissional->id == $vendaservicos->profissional_id ? 'selected' : '' }}>
                                                {{ $profissional->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Valor</label>
                                    <input type="text" class="form-control" name="valor"
                                        value="{{ $vendaservicos->valor }}">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Método Pagamento</label>
                                    <select name="metodopagamento" id="metodopagamento" class="form-control">
                                        <option value="Pix"
                                            {{ $vendaservicos->metodopagamento === 'Pix' ? 'selected' : '' }}>Pix</option>
                                        <option value="Dinheiro"
                                            {{ $vendaservicos->metodopagamento === 'Dinheiro' ? 'selected' : '' }}>Dinheiro
                                        </option>
                                        <option value="Cartão"
                                            {{ $vendaservicos->metodopagamento === 'Cartão' ? 'selected' : '' }}>Cartão
                                        </option>
                                        <option value="Boleto"
                                            {{ $vendaservicos->metodopagamento === 'Boleto' ? 'selected' : '' }}>Boleto
                                        </option>
                                        <option value="Deve"
                                            {{ $vendaservicos->metodopagamento === 'Deve' ? 'selected' : '' }}>Deve
                                        </option>
                                        <option value="Pago - Ficha"
                                            {{ $vendaservicos->metodopagamento === 'Pago - Ficha' ? 'selected' : '' }}>Pago
                                            - Ficha
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Data Venda</label>
                                    <input type="date" class="form-control" name="datavenda"
                                        value="{{ $vendaservicos->datavenda }}">
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary btn-1">Atualizar</button>
                                </div>
                            </form><!-- Vertical Form -->
                            <div class="col-12 mt-2">
                                <a href="/vendaservicos"> <button class="btn btn-primary btn-1 btn-back"><i
                                            class="bi bi-skip-backward-fill mr-2"></i>Voltar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
