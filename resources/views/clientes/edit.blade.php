@extends('header')

@section('content')
    <main id="main" class="">
        <div class="col-lg-10 offset-1">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Editando Cliente - {{ $client->nome }}</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="{{ route('clientes.update', ['id' => $client->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nome" value="{{ $client->nome }}">
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Cidade</label>
                            <input type="text" class="form-control" name="cidade" value="{{ $client->cidade }}">
                        </div>
                        <div class="col-12">
                            <label for="inputPassword4" class="form-label">Telefone</label>
                            <input type="text" class="form-control" name="telefone" value="{{ $client->telefone }}">
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">CPF</label>
                            <input type="text" class="form-control" name="cpf" value="{{ $client->cpf }}">
                        </div>
                        <div class="col-12">

                            @if ($client->data)
                                <?php
                                $formattedDate = substr($client->data, 0, 10);
                                ?>
                            @else
                                <?php
                                $formattedDate = $client->data;
                                ?>
                            @endif

                            <label for="" class="form-label">Data Último Serviço</label>
                            <input type="date" class="form-control" name="data" value="{{ $formattedDate }}">
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-1">Salvar</button>
                        </div>
                    </form><!-- Vertical Form -->
                    <div class="col-12 mt-2">
                        <a href="/clientes"> <button class="btn btn-primary btn-1 btn-back"><i
                                    class="bi bi-skip-backward-fill mr-2"></i>Voltar</button></a>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
