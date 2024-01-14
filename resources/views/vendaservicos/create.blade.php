@extends('header')

@section('content')
    <main id="main" class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-1">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cadastre a venda de um Serviço</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" action="/vendaservicos" method="POST">
                                @csrf

                                <div class="col-12">
                                    <label for="" class="form-label">Serviços</label>
                                    <select name="servico_id[]" class="form-control select2-single" multiple>
                                        @foreach ($servicos as $servico)
                                            <option value="{{ $servico->id }}">{{ $servico->nome }}</option>
                                            {{-- <option value="1">Produto 01</option> --}}
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="" class="form-label">Cliente</label>
                                    <select class="select2 form-control" name="cliente_id">
                                        <option value="">Selecione</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                            {{-- <option value="2">Cliente 01</option> --}}
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Profissional</label>
                                    <select class="select2 form-control" name="profissional_id" id="select-profissional">
                                        <option value="">Selecione</option>
                                        @foreach ($profissionais as $profissional)
                                            <option value="{{ $profissional->id }}">{{ $profissional->nome }}</option>
                                            {{-- <option value="1">Profissional 01</option> --}}
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Valor</label>
                                    <input type="text" class="form-control" name="valor">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Método Pagamento</label>
                                    <select name="metodopagamento" id="" class="form-control">
                                        <option value="Cartao">Cartão</option>
                                        <option value="Dinheiro">Dinheiro</option>
                                        <option value="Pix">Pix</option>
                                        <option value="Boleto">Boleto</option>
                                        <option value="Deve">Deve</option>
                                        <option value="Pago - Ficha">Pago - Ficha</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="" class="form-label">Data Venda</label>
                                    <input type="date" class="form-control" name="datavenda">
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary btn-1">Cadastrar</button>
                                    <!-- <button type="reset" class="btn btn-secondary">Limpar</button> -->
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
