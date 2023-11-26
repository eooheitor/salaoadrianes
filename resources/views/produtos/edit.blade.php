@extends('header')

@section('content')
    <main id="main" class="">
        <div class="col-lg-10 offset-1">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Editando Produto - {{ $product->nome }}</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" action="{{ route('produtos.update', ['id' => $product->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label for="" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nome" value="{{ $product->nome }}">
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Quantidade</label>
                            <input type="number" class="form-control" name="quantidade" value="{{ $product->quantidade }}">
                        </div>
                        <div class="col-12">
                            <label for="inputPassword4" class="form-label">Tamanho</label>
                            <input type="text" class="form-control" name="tamanho" value="{{ $product->tamanho }}">
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">CodProduto</label>
                            <input type="text" class="form-control" name="codproduto" value="{{ $product->codproduto }}">
                        </div>
                        <div class="col-12">

                            @if ($product->datacompra)
                                <?php
                                $formattedDate = substr($product->datacompra, 0, 10);
                                ?>
                            @else
                                <?php
                                $formattedDate = $product->datacompra;
                                ?>
                            @endif

                            <label for="" class="form-label">Data Compra</label>
                            <input type="date" class="form-control" name="datacompra" value="{{ $formattedDate }}">
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary btn-1">Salvar</button>
                        </div>
                    </form><!-- Vertical Form -->
                    <div class="col-12 mt-2">
                        <a href="/produtos"> <button class="btn btn-primary btn-1 btn-back"><i
                                    class="bi bi-skip-backward-fill mr-2"></i>Voltar</button></a>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
