<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\VendaProductController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\VendaServiceController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PdfProdutoController;


Route::view('/', [HomeController::class, 'index']);

//--------------CLIENTES----------------

Route::get('/criar/clientes', function () {
    return view('clientes.create');
});

Route::get('/clientes', [HomeController::class, 'index']);

Route::post('/clientes', [HomeController::class, 'store']);
Route::delete('/clientes/{id}', [HomeController::class, 'destroy']);
Route::get('/clientes/edit/{id}', [HomeController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/update/{id}', [HomeController::class, 'update'])->name('clientes.update');

//-------------- END CLIENTES----------------

//-------------Produtos ---------------------

Route::get('/criar/produtos', function () {
    return view('produtos.create');
});

Route::get('/produtos', [ProdutoController::class, 'index']);

Route::post('/produtos', [ProdutoController::class, 'store']);
Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy']);
Route::get('/produtos/edit/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');
Route::put('/produtos/update/{id}', [ProdutoController::class, 'update'])->name('produtos.update');

//-------------Profissionais ---------------------

Route::get('/criar/profissionais', function () {
    return view('profissionais.create');
});

Route::get('/profissionais', [ProfissionalController::class, 'index']);
Route::post('/profissionais ', [ProfissionalController::class, 'store']);
Route::delete('/profissionais/{id}', [ProfissionalController::class, 'destroy']);
Route::get('/profissionais/edit/{id}', [ProfissionalController::class, 'edit'])->name('profissionais.edit');
Route::put('/profissionais/update/{id}', [ProfissionalController::class, 'update'])->name('profissionais.update');

//-------------Venda Produto ---------------------

Route::get('/criar/vendaprodutos', [VendaProductController::class, 'create']);

Route::get('/vendaprodutos', [VendaProductController::class, 'index']);
Route::post('/vendaprodutos ', [VendaProductController::class, 'store']);
Route::delete('/vendaprodutos/{id}', [VendaProductController::class, 'destroy']);
Route::get('/vendaprodutos/edit/{id}', [VendaProductController::class, 'edit'])->name('vendaprodutos.edit');
Route::put('/vendaprodutos/update/{id}', [VendaProductController::class, 'update'])->name('vendaprodutos.update');

//------------------Serviços--------------------------
Route::get('/criar/servicos', [ServicoController::class, 'create']);

Route::get('/servicos', [ServicoController::class, 'index']);
Route::post('/servicos ', [ServicoController::class, 'store']);
Route::delete('/servicos/{id}', [ServicoController::class, 'destroy']);
Route::get('/servicos/edit/{id}', [ServicoController::class, 'edit'])->name('servicos.edit');
Route::put('/servicos/update/{id}', [ServicoController::class, 'update'])->name('servicos.update');

//---------------Venda Serviço-----------------------
Route::get('/criar/vendaservicos', [VendaServiceController::class, 'create']);

Route::get('/vendaservicos', [VendaServiceController::class, 'index']);
Route::post('/vendaservicos ', [VendaServiceController::class, 'store']);
Route::delete('/vendaservicos/{id}', [VendaServiceController::class, 'destroy']);
Route::get('/vendaservicos/edit/{id}', [VendaServiceController::class, 'edit'])->name('vendaservicos.edit');
Route::put('/vendaservicos/update/{id}', [VendaServiceController::class, 'update'])->name('vendaservicos.update');

//-------------------Impressão DOMPDF---------------

// Route::get('/pdf', [PdfController::class, 'generatePDF']);
Route::post('/pdf', [PdfController::class, 'generatePDF'])->name('generatePDF');
Route::post('/pdfproduto', [PdfProdutoController::class, 'geraPDF'])->name('geraPDF');
