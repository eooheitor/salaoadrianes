@extends('header')

@section('content')
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card mt-2">
                            <div class="card-body">
                                <h5 class="card-title">Tabela de Produtos</h5>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <div class="botao">
                                        <a href="/produtos/create"><button
                                                class="btn btn-primary btn-1">Cadastrar</button></a>
                                    </div>
                                    <form action="" method="GET">
                                        <input type="text" id="search" name="search" placeholder="Procure um Produto"
                                            class="form-control mb-4">
                                        <!-- <button type="submit" class="btn btn-primary">Enviar</button> -->
                                    </form>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            @if (count($products) == 0 && $search)
                                                <h5 class="">Não há nenhum Produto com o nome {{ $search }} <a
                                                        href="/produtos"><button class="btn btn-secondary">Ver
                                                            todos</button></a></h5>
                                            @elseif(count($products) == 0)
                                                <h2 class="">Não há Produtos cadastrados</h2>
                                            @else
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Quantidade</th>
                                                    <th scope="col">Tamanho</th>
                                                    <th scope="col">Valor</th>
                                                    <th scope="col">CodProduto</th>
                                                    <th scope="col">Data Compra</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>

                                                        <button type="button" class="btn-icon" data-toggle="modal"
                                                            data-target="#modalExemplo-{{ $product->id }}"><i
                                                                class="bi bi-trash"></i></button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modalExemplo-{{ $product->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="exampleModalLabel-{{ $product->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel-{{ $product->id }}">
                                                                            Excluir <i class="bi bi-trash"></i> </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Fechar">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Tem certeza que deseja excluir? <br> Depois de
                                                                        excluído não terá como recuperar essa informação!
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Fechar</button>
                                                                        <form action="/produtos/{{ $product->id }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Excluir</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="{{ route('produtos.edit', ['id' => $product->id]) }}">
                                                            <button class="btn-icon2"><i
                                                                    class="bi bi-pencil-square"></i></button></a>
                                                    </td>
                                                    <th scope="row">{{ $product->id }}</th>
                                                    <td class="text-uppercase">{{ $product->nome }}</td>
                                                    <td class="text-uppercase">{{ $product->quantidade }}</td>
                                                    <td class="text-uppercase">{{ $product->tamanho }}</td>
                                                    <td class="text-uppercase">{{ $product->valor }}</td>
                                                    <td class="text-uppercase">{{ $product->codproduto }}</td>
                                                    <td class="text-uppercase">{{ date('d/m/Y', strtotime($product->datacompra)) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        @endif
                                    </table>
                                    <div>
                                        <?php
                                        if (!$search) {
                                            echo $products->onEachSide(0)->links();
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
