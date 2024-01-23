<?php


use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return inertia::render('index');
// });

//Show Dashboard
Route::get('/',[ProductController::class, 'index'])->name('customers.index');

//Show ProductList
Route::get('/productlist',[ProductController::class, 'productlist'])->name('productlist');

//Show Register
Route::get('/register',[ProductController::class, 'register']);

//Show Login
Route::get('/login',[ProductController::class, 'login']);

//Store New Product
Route::post('/addproducts',[ProductController::class, 'store']);

//Show Add Product
Route::get('/addproduct',[ProductController::class, 'addproduct']);

//Log In User
Route::post('/login/authenticate',[UserController::class, 'authenticate']);

//Show Edit
Route::get('/productlist/{product}/edit',[ProductController::class, 'edit']);

//Store New Edit Product
Route::put('/productlist/{product}',[ProductController::class, 'update']);

//Delete Product
Route::delete('/productlist/{product}/delete',[ProductController::class, 'delete']);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
