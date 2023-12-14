
<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\VendaProductController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\VendaServiceController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PdfProdutoController;
use App\Http\Controllers\Auth\RegisterController;

Route::middleware(['auth'])->group(function () {

    Route::view('/', [HomeController::class, 'index']);

    // Rotas para CLIENTES
    Route::prefix('clientes')->group(function () {
        Route::get('/create', [ClienteController::class, 'create']);
        Route::get('/', [ClienteController::class, 'index']);
        Route::post('/', [ClienteController::class, 'store']);
        Route::delete('/{id}', [ClienteController::class, 'destroy']);
        Route::get('/edit/{id}', [ClienteController::class, 'edit'])->name('clientes.edit');
        Route::put('/update/{id}', [ClienteController::class, 'update'])->name('clientes.update');
    });

    // Rotas para PRODUTOS
    Route::prefix('produtos')->group(function () {
        Route::get('/create', [ProdutoController::class, 'create']);
        Route::get('/', [ProdutoController::class, 'index']);
        Route::post('/', [ProdutoController::class, 'store']);
        Route::delete('/{id}', [ProdutoController::class, 'destroy']);
        Route::get('/edit/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');
        Route::put('/update/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
    });

    // Rotas para PROFISSIONAIS
    Route::prefix('profissionais')->group(function () {
        Route::get('/create', [ProfissionalController::class, 'create']);
        Route::get('/', [ProfissionalController::class, 'index']);
        Route::post('/', [ProfissionalController::class, 'store']);
        Route::delete('/{id}', [ProfissionalController::class, 'destroy']);
        Route::get('/edit/{id}', [ProfissionalController::class, 'edit'])->name('profissionais.edit');
        Route::put('/update/{id}', [ProfissionalController::class, 'update'])->name('profissionais.update');
    });

    // Rotas para VENDA DE PRODUTOS
    Route::prefix('vendaprodutos')->group(function () {
        Route::get('/create', [VendaProductController::class, 'create']);
        Route::get('/', [VendaProductController::class, 'index']);
        Route::post('/', [VendaProductController::class, 'store']);
        Route::delete('/{id}', [VendaProductController::class, 'destroy']);
        Route::get('/edit/{id}', [VendaProductController::class, 'edit'])->name('vendaprodutos.edit');
        Route::put('/update/{id}', [VendaProductController::class, 'update'])->name('vendaprodutos.update');
    });

    // Rotas para SERVIÇOS
    Route::prefix('servicos')->group(function () {
        Route::get('/create', [ServicoController::class, 'create']);
        Route::get('/', [ServicoController::class, 'index']);
        Route::post('/', [ServicoController::class, 'store']);
        Route::delete('/{id}', [ServicoController::class, 'destroy']);
        Route::get('/edit/{id}', [ServicoController::class, 'edit'])->name('servicos.edit');
        Route::put('/update/{id}', [ServicoController::class, 'update'])->name('servicos.update');
    });

    // Rotas para VENDA DE SERVIÇOS
    Route::prefix('vendaservicos')->group(function () {
        Route::get('/create', [VendaServiceController::class, 'create']);
        Route::get('/', [VendaServiceController::class, 'index']);
        Route::post('/', [VendaServiceController::class, 'store']);
        Route::delete('/{id}', [VendaServiceController::class, 'destroy']);
        Route::get('/edit/{id}', [VendaServiceController::class, 'edit'])->name('vendaservicos.edit');
        Route::put('/update/{id}', [VendaServiceController::class, 'update'])->name('vendaservicos.update');
    });

    //-------------------Impressão DOMPDF---------------
    Route::post('/pdf', [PdfController::class, 'generatePDF'])->name('generatePDF');
    Route::post('/pdfproduto', [PdfProdutoController::class, 'geraPDF'])->name('geraPDF');

    //------------------Auth-------------------------
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Rotas de login e logout
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');