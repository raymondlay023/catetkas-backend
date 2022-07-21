<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function createShop(Request $request){
        $request->validate([
            'name' => ['required','String','max:255'],
            'phone_number' => ['required','String','max:15'],
            'category' => ['required','String']
        ]);

        $shop = Shop::create([
            'users_id' => Auth::user()->id,
            'name' => $request->name, 
            'phone_number' => $request->phone_number,
            'category' => $request->category,
        ]);

        return ResponseFormatter::success($shop,'Shop Registered');
    }

    public function readShop(){
        $shop = Shop::where('users_id', Auth::user()->id)->first();
        return ResponseFormatter::success($shop, 'Data list shop telah diambil');
    }

    public function updateShop(Request $request){
        Shop::where('users_id', Auth::user()->id)->update($request->all());
        $shop = Shop::where('users_id', Auth::user()->id)->first();
        return ResponseFormatter::success($shop, 'Shop updated');
    }
}
