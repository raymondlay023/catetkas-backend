<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function createProduct(Request $request){
        $request->validate([
            'name' => ['required','string','max:255'],
            'stock' => 'required',
            'price' => 'required',
            'capital' => 'required'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'capital' => $request->capital
        ]);

        return ResponseFormatter::success($product,'Produk berhasil ditambahkan');
    }
    public function readProduct(){
        $product = Product::all();
        return ResponseFormatter::success(
            $product,
            'Data list produk berhasil diambil',
        ); 
    }
    public function updateProduct(Request $request){
        $request->validate([
            'name' => ['required','string','max:255'],
            'stock' => 'required',
            'price' => 'required',
            'capital' => 'required'
        ]);

        $data = $request->all();
        $product = update($data);
        return ResponseFormatter::success($product, 'Produk berhasil diupdate');
    }
    public function deleteProduct(Request $request){

    }
}
