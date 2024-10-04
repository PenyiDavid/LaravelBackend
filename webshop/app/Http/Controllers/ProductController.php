<?php

namespace App\Http\Controllers;

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){

        //return view('products.products', 
        //  ['products' => Product::all()->where('stock', '>', '0')]);

        $query = Product::query();
        $query->where('stock', '>', '0');

        $query->where('product_type_id','like', '1');

        if($request->has('brand') && !empty($request->brand)){
            $query->where('brand', 'like', $request->brand);
        }
        if($request->has('modell') && !empty($request->modell)){
            $query->where('modell', 'like', $request->modell);
        }
        
        if($request->has('min_price') && !empty($request->min_price)){
            $query->where('price', '>=', $request->min_price);
        }
        if($request->has('max_price') && !empty($request->max_price)){
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();
        return view('products.shoes.products', compact('products'));
    }

    public function clothes_index(Request $request){

        //return view('products.products', 
        //  ['products' => Product::all()->where('stock', '>', '0')]);

        $query = Product::query();
        $query->where('stock', '>', '0');

        $query->where('product_type_id','like', '2');

        if($request->has('brand') && !empty($request->brand)){
            $query->where('brand', 'like', $request->brand);
        }
        if($request->has('modell') && !empty($request->modell)){
            $query->where('modell', 'like', $request->modell);
        }
        
        if($request->has('min_price') && !empty($request->min_price)){
            $query->where('price', '>=', $request->min_price);
        }
        if($request->has('max_price') && !empty($request->max_price)){
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();
        return view('products.clothes.products', compact('products'));
    }

    public function store(Request $request){

        $request->validate([
            'brand' => 'required|string|max:255',
            'modell' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'size' => 'required|integer|min:34|max:48',
            'stock' => 'required|integer|min:0|max:80',
            'price' => 'required|integer|min:3000|max:1000000',
            'product_type_id' => 'required|integer'
        ]);

        Product::create([
            'brand' => $request->brand,
            'modell' => $request->modell,
            'color' => $request->color,
            'size' => $request->size,
            'stock' => $request->stock,
            'price' => $request->price,
            'product_type_id' => $request->product_type_id
        ]);

        /*$product = new Product();
        $product->brand = $request->brand;
        $product->modell = $request->modell;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->stock = $request->stock;
        $product->price = $request->price;
        if($product->save()){
            return redirect()->route('products.index')->with('success', 'product successfully added.');
        }
        else{
            return redirect()->back()->with('error', 'Something wrong.');
        }*/

        return redirect()->route('products.index')->with('success', 'Termék sikeresen hozzáadva');
    }

    public function update(Request $request, $id){
        $product = Product::find($id);

        $request->validate([
            'quantity'=>'required|integer|min:1',
        ]);

        if($request->quantity > $product->stock)
            return redirect()->route('products.index')
                ->with('error', 'Nincs ennyi termék');

        $product->stock -= $request->quantity;
        $product->save();

        return redirect()->route('products.index')
                ->with('succes', 'Sikeres vásárlás');

    }

    public function destroy($id){
        $product = Product::find($id);

        if($product){
            $product->delete();
            return redirect()->route('products.index')->with('success', 'A termék sikeresen törölve.');
        }
        else redirect()->route('products.index')->with('error', 'A termék nem található.');
    }
}
