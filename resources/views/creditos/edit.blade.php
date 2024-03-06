@extends('header')

@section('content')
    <main id="main" class="">
        <div class="col-lg-10 offset-1">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Editando o Crédito - {{ $credito->nome }}</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="{{ route('creditos.update', ['id' => $credito->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nome" value="{{ $credito->nome }}">
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Valor</label>
                            <input type="text" class="form-control" name="valor" value="{{ $credito->valor }}">
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Status</label>
                            <select name="status" id="" class="form-control">
                                <option value="" selected disabled>Selecione</option>
                                <option value="Débito" {{ $credito->status === 'Débito' ? 'selected' : '' }}>Débito</option>
                                <option value="Crédito" {{ $credito->status === 'Crédito' ? 'selected' : '' }}>Crédito</option>
                            </select>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-1">Salvar</button>
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
    </main>
@endsection
