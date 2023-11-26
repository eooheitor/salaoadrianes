<!DOCTYPE html>
<html lang="pt-br ">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <title>Pdf</title>
</head>

<style>
    .mr {
        margin-left: -30px !important
    }
</style>

<body>
    <div class="container-fluid mr">
        <div class="row">
            <div class="col-12">
                <div class="max-width">
                    <h2 class="text-center mb-4">Tabela Venda de Produtos</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Cliente</th>
                                    <th>Profissional</th>
                                    <th>Valor</th>
                                    <th>Método de Pagamento</th>
                                    <th>Comissão Profissional</th>
                                    <th>Data Venda</th>
                                </tr>
                            </thead>
                            @php
                                $totalVendasEmpresa = 0;
                                $totalVendas = 0;
                                $totalPorProfissional = [];
                            @endphp

                            <tbody>
                                @foreach ($vendaprodutos as $vendaproduto)
                                    <tr>
                                        <td>
                                            @foreach ($produtosAgrupados as $grupo)
                                                @if ($grupo['vendaproduto_id'] == $vendaproduto->id)
                                                    {{ implode(', ', $grupo['produtos']) }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $vendaproduto->cliente->nome }}</td>
                                        <td>{{ $vendaproduto->profissional->nome }}</td>
                                        <td>{{ $vendaproduto->valor }}R$</td>
                                        <td>{{ $vendaproduto->metodopagamento }}</td>
                                        <td>{{ $vendaproduto->profissional->comissao }}%</td>
                                        <td>{{ date('d/m/Y', strtotime($vendaproduto->datavenda)) }}</td>
                                    </tr>
                                    @php
                                        $profissionalId = $vendaproduto->profissional->id;
                                        $comissao = ($vendaproduto->valor * $vendaproduto->profissional->comissao) / 100;

                                        if (!isset($totalPorProfissional[$profissionalId])) {
                                            $totalPorProfissional[$profissionalId] = 0;
                                        }
                                        $totalPorProfissional[$profissionalId] += $comissao;
                                        $totalVendas += $comissao;
                                        $totalVendasEmpresa += $vendaproduto->valor;
                                    @endphp

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p>Valor Total: R$ {{ $totalVendasEmpresa }} </p>

                    @foreach ($totalPorProfissional as $profissionalId => $comissao)
                        @php
                            $profissional = App\Models\Professional::find($profissionalId);
                        @endphp
                        <p>Comissão de {{ $profissional->nome }}: R$ {{ $comissao }}</p>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</body>

</html>
