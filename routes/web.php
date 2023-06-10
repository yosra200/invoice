 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\sectionsController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\invoices_report;
use App\Http\Controllers\Customers_Report;





use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('/invoices', InvoicesController::class);
Route::resource('/sections', SectionsController::class);
Route::resource('/products', productsController::class);
Route::get('/section/{id}', [InvoicesController::class,'getproducts']);
Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class,'edit']);
Route::get('/view_file/{invoice_number}{file_name}', [InvoicesDetailsController::class,'open_file']);
Route::get('/download_file/{invoice_number}{file_name}', [InvoicesDetailsController::class,'get_file']);
Route::Post('/delete_file', [invoicesDetailsController::class,'destroy'])->name('delete_file');
Route::resource('/InvoiceAttachments', InvoiceAttachmentsController::class);
Route::get('/edit_invoice/{id}', [InvoicesController::class,'edit']);
Route::get('/Status_show/{id}', [InvoicesController::class,'show'])->name('Status_show');
Route::post('/Status_Update/{id}',[InvoicesController::class,'Status_Update'])->name('Status_Update');
Route::resource('Archive', InvoiceAchiveController::class);

Route::get('Invoice_Paid',[InvoicesController::class,'Invoice_Paid']);

Route::get('Invoice_UnPaid',[InvoicesController::class,'Invoice_UnPaid']);

Route::get('Invoice_Partial',[InvoicesController::class,'Invoice_Partial']);

Route::get('Print_invoice/{id}', [InvoicesController::class,'Print_invoice']);
Route::get('export_invoices', [InvoicesController::class, 'export']);
Route::get('invoices_report', [ Invoices_Report::class, 'index']);
Route::post('Search_invoices', [ Invoices_Report::class, 'Search_invoices']);
Route::get('Customers_Report', [ Customers_Report::class, 'index']);
Route::post('Search_customers', [ Customers_Report::class, 'Search_customers']);
Route::get('MarkAsRead_all', [ InvoicesController::class, 'MarkAsRead_all']);


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','\App\Http\Controllers\RoleController');
    Route::resource('users','\App\Http\Controllers\UserController');
    });

Route::get('/{page}', [AdminController::class, 'index']);

