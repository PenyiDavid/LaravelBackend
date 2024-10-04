<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use App\Models\Product_type;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/products', function() {
    $products = [['brand' => 'Nike', 'modell'=>'Airmax', 'color' => 'black', 'size' => 43, 'price'=>60000],
                ['brand' => 'Puma', 'modell'=>'Faszacipő', 'color' => 'white', 'size' => 48, 'price'=>40000]
];
    return view('products', ['products' => $products]);
});*/

Route::get('/shoes/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/clothes/products', [ProductController::class, 'clothes_index'])->name('products.clothes.index');
Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('update_stock');

Route::get('/new_product', function() { 
    $types = Product_type::all();
    return view('products.new_product', ['types' => $types]);
});
Route::post('/new_product', [ProductController::class, 'store']);

Route::delete('/products/{id}',[ProductController::class, 'destroy'])->name('delete_product');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
