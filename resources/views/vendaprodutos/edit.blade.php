@extends('header')

@section('content')
    <main id="main" class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-1">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Editar Venda de Produto</h5>

                            <!-- Vertical Form -->
                            <form class="row g-3" action="{{ route('vendaprodutos.update', ['id' => $vendaprodutos->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="col-12">
                                    <label for="" class="form-label">Produtos</label>
                                    <select name="produto_id[]" class="form-control select2-single" multiple>
                                        @foreach ($produtosDisponiveis as $produto)
                                            <option value="{{ $produto->id }}"
                                                @if ($produtosAssociados->contains('produto_id', $produto->id)) selected @endif>
                                                {{ $produto->nome }}
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
                                                {{ $cliente->id == $vendaprodutos->cliente_id ? 'selected' : '' }}>
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
                                                {{ $profissional->id == $vendaprodutos->profissional_id ? 'selected' : '' }}>
                                                {{ $profissional->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Valor</label>
                                    <input type="text" class="form-control" name="valor"
                                        value="{{ $vendaprodutos->valor }}">
                                </div>
                                <div class="col-12">
                                    <label for="metodopagamento" class="form-label">Método Pagamento</label>
                                    <select name="metodopagamento" id="metodopagamento" class="form-control">
                                        <option value="Pix"
                                            {{ $vendaprodutos->metodopagamento === 'Pix' ? 'selected' : '' }}>Pix</option>
                                        <option value="Dinheiro"
                                            {{ $vendaprodutos->metodopagamento === 'Dinheiro' ? 'selected' : '' }}>Dinheiro
                                        </option>
                                        <option value="Cartão"
                                            {{ $vendaprodutos->metodopagamento === 'Cartão' ? 'selected' : '' }}>Cartão
                                        </option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <label for="" class="form-label">Tipo Pessoa</label>
                                    <input type="text" class="form-control" name="tipopessoa"
                                        value="{{ $vendaprodutos->tipopessoa }}">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Data Venda</label>
                                    <input type="date" class="form-control" name="datavenda"
                                        value="{{ $vendaprodutos->datavenda }}">
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary btn-1">Atualizar</button>
                                </div>
                            </form><!-- Vertical Form -->
                            <div class="col-12 mt-2">
                                <a href="/vendaprodutos"> <button class="btn btn-primary btn-1 btn-back"><i
                                            class="bi bi-skip-backward-fill mr-2"></i>Voltar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
