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
                            <h5 class="card-title">Cadastre um Crédito</h5>
                            <!-- Vertical Form -->
                            <form id="form-credito" class="row g-3" action="/creditos" method="POST">
                                @csrf
                                <div class="col-12">
                                    <label for="" class="form-label">Nome</label>
                                    <input type="text" value="{{ old('nome') }}" class="form-control" name="nome">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Valor</label>
                                    <input type="text" value="{{ old('valor') }}" class="form-control" name="valor">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label">Status</label>
                                    <select name="status" id="" class="form-control">
                                        <option value="" selected disabled>Selecione</option>
                                        <option value="Débito">Débito</option>
                                        <option value="Crédito">Crédito</option>
                                    </select>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary btn-1">Cadastrar</button>
                                </div>
                            </form>
                            <div class="col-12 mt-2">
                                <a href="/creditos"> <button class="btn btn-primary btn-1 btn-back"><i
                                            class="bi bi-skip-backward-fill mr-2"></i>Voltar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
