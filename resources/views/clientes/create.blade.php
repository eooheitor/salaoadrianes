@extends('header')

@section('content')
    <main id="main" class="">
        <div class="container">
            <div class="row">
                @if ($errors->any())
                    @foreach ($errors->all() as $index => $error)
                        <div class="toast align-items-center text-white bg-danger border-0" role="alert"
                            aria-live="assertive" aria-atomic="true" data-delay="{{ $index * 1000 }}">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ $error }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cadastre um Cliente</h5>
                            <!-- Vertical Form -->
                            <form class="row g-3" action="/clientes" method="POST">
                                @csrf
                                <div class="col-12">
                                    <label for="" class="form-label">Nome</label>
                                    <input type="text" value="{{ old('nome') }}" class="form-control" name="nome">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Cidade</label>
                                    <input type="text" value="{{ old('cidade') }}" class="form-control" name="cidade">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Telefone</label>
                                    <input type="text" value="{{ old('telefone') }}" class="form-control"
                                        name="telefone">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">CPF</label>
                                    <input type="text" value="{{ old('cpf') }}" class="form-control" name="cpf">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Data Último Serviço</label>
                                    <input type="date" value="{{ old('data') }}" class="form-control" name="data">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Data de nascimento</label>
                                    <input type="date" value="{{ old('datanascimento') }}" class="form-control"
                                        name="datanascimento">
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary btn-1">Cadastrar</button>
                                    <!-- <button type="reset" class="btn btn-secondary">Limpar</button> -->
                                </div>
                            </form><!-- Vertical Form -->
                            <div class="col-12 mt-2">
                                <a href="/clientes"> <button class="btn btn-primary btn-1 btn-back"><i
                                            class="bi bi-skip-backward-fill mr-2"></i>Voltar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
