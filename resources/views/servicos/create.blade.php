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
                            <h5 class="card-title">Cadastre um Serviço</h5>
                            <!-- Vertical Form -->
                            <form id="form-servico" class="row g-3" action="/servicos" method="POST">
                                @csrf
                                <div class="col-12">
                                    <label for="" class="form-label">Nome Serviço</label>
                                    <input type="text" value="{{ old('nome') }}" class="form-control" name="nome">
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-primary btn-1">Cadastrar</button>
                                    <!-- <button type="reset" class="btn btn-secondary">Limpar</button> -->
                                </div>
                            </form><!-- Vertical Form -->
                            <div class="col-12 mt-2">
                                <a href="/servicos"> <button class="btn btn-primary btn-1 btn-back"><i
                                            class="bi bi-skip-backward-fill mr-2"></i>Voltar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
