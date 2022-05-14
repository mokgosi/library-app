<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Request;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/categories', function (Request $request) {
    return view('categories');
})->middleware(['auth'])->name('categories');

Route::get('/books', function (Request $request) {
    return view('books');
})->middleware(['auth'])->name('books');

Route::get('/members', function (Request $request) {
    return view('members',[
        // 'audit-trail' => []
    ]);
})->middleware(['auth'])->name('audit_trails');

require __DIR__.'/auth.php';

Route::view('/categories/{any}', 'categories')
->middleware('auth')
->where('any','.*');

Route::view('/books/{any}', 'books')
->middleware('auth')
->where('any','.*');

Route::view('/members/{any}', 'members')
->middleware('auth')
->where('any','.*');
