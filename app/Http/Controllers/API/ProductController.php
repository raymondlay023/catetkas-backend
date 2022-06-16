<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function createProduct(Request $request){
        $request->validate([
            'name' => ['required','string','max:255'],
            'stock' => 'required',
            'price' => 'required',
            'capital' => 'required'
        ]);

        $shops_id = Shop::where('users_id', Auth::user()->id)->value('id');
        $product = Product::create([
            'shops_id' => $shops_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'capital' => $request->capital
        ]);

        return ResponseFormatter::success($product,'Data produk berhasil ditambahkan');
    }

    public function readProduct(){
        $shops_id = Shop::where('users_id', Auth::user()->id)->value('id');
        $products = Product::where('shops_id',$shops_id)->get();
        
        return ResponseFormatter::success(
            $products,
            'Data list produk berhasil diambil',
        ); 
    
    }

    public function updateProduct(Request $request){
        $id = $request->input('id');
        Product::find($id)->update($request->all());
        $product = Product::find($id);
        return ResponseFormatter::success($product, 'Data produk berhasil diupdate');
    }

    public function deleteProduct(Request $request){
        $id = $request->input('id');
        Product::find($id)->delete();
        return ResponseFormatter::success([
            'message'=>'Data produk berhasil dihapus'
        ]);
    }
}
