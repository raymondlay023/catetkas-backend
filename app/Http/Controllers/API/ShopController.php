<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function createShop(Request $request){
        $request->validate([
            'name' => ['required','String','max:255'],
            'phone_number' => ['required','String','max:150'],
            'category' => ['required','String']
        ]);

        $shop = Shop::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'category' => $request->category,
        ]);

        return ResponseFormatter::success($shop,'Shop Registered');
    }

    public function readShop(Request $request){
        $shop = Shop::all();
        return ResponseFormatter::success($shop, 'Data list shop telah diambil');
    }

    public function updateShop(Request $request){
        $request->validate([
            'name' => ['required', 'String','max:255'],
            'phone_number' => ['required', 'String', 'max:150'],
            'category' =>  $request->category,
            
        ]);

        $data = $request->all();
        $shop = update($data);
        return ResponseFormatter::success($shop, 'Shop updated');
    }
}
