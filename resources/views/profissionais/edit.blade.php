@extends('header')

@section('content')
    <main id="main" class="">
        <div class="col-lg-10 offset-1">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Editando Produto - {{ $profissional->nome }}</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="{{ route('profissionais.update', ['id' => $profissional->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nome" value="{{ $profissional->nome }}">
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Comissão</label>
                            <input type="number" class="form-control" name="comissao" value="{{ $profissional->comissao }}">
                        </div>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-1">Salvar</button>
                        </div>
                    </form><!-- Vertical Form -->
                    <div class="col-12 mt-2">
                        <a href="/profissionais"> <button class="btn btn-primary btn-1 btn-back"><i
                                    class="bi bi-skip-backward-fill mr-2"></i>Voltar</button></a>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
