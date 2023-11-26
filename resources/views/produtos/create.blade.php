@extends('header')

@section('content')
    <main id="main" class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-1">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cadastre um Produto</h5>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Vertical Form -->
                            <form class="row g-3" action="/produtos" method="POST">
                                @csrf
                                <div class="col-12">
                                    <label for="" class="form-label">Nome</label>
                                    <input type="text" value="{{ old('nome') }}" class="form-control" name="nome">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Quantidade</label>
                                    <input type="number" value="{{ old('quantidade') }}" class="form-control"
                                        name="quantidade">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Tamanho</label>
                                    <input type="text" value="{{ old('tamanho') }}" class="form-control" name="tamanho">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">CodProduto</label>
                                    <input type="text" value="{{ old('codproduto') }}" class="form-control"
                                        name="codproduto">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Data Compra</label>
                                    <input type="date" value="{{ old('datacompra') }}" class="form-control"
                                        name="datacompra">
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary btn-1">Cadastrar</button>
                                    <!-- <button type="reset" class="btn btn-secondary">Limpar</button> -->
                                </div>
                            </form><!-- Vertical Form -->
                            <div class="col-12 mt-2">
                                <a href="/produtos"> <button class="btn btn-primary btn-1 btn-back"><i
                                            class="bi bi-skip-backward-fill mr-2"></i>Voltar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
