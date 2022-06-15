<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function createTransaction(Request $request){
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'exists:products,id',
            'total' => 'required',
            'type' => 'required|in:PEMASUKAN,PENGELUARAN',
        ]);

        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'note' => $request->note,
            'total' => $request->total,
            'type' => $request->type,
        ]);
    
        foreach ($request->items as $product){
            TransactionItem::create([
                'users_id' => Auth::user()->id,
                'products_id' => $product['id'],
                'transactions_id' => $transaction->id,
                'quantity' => $product['quantity'],
            ]);
        }

        return ResponseFormatter::success($transaction->load('items.product'), 'Transaksi Berhasil');
    }

    public function readTransaction(Request $request){
        $id = $request->input('id');
        $limit = $request->input('limit',6);
        $type = $request->input('type');

        $transaction = Transaction::all();

        if($id){
            $transaction = Transaction::find($id);

            if($transaction){
                return ResponseFormatter::success(
                    $transaction, 
                    'Data transaksi berhasil diambil',
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data transaksi tidak ada',
                    404,
                );
            }
        }
            if($type){
                $transaction = Transaction::where('type', $type);
                // $transaction = Transaction::find($type);
                if($transaction){
                    return ResponseFormatter::success(
                        $transaction, 
                        'Data transaksi berhasil diambil');
                } else {
                    return ResponseFormatter::error(
                        null,
                        'Data transaksi tidak ada',
                        404,
                    );
                }
            }
            return ResponseFormatter::success(
                $transaction->paginate($limit),
                'Data list transaksi berhasil diambil'
            );
            $transaction = Transaction::with(['items.product'])->where('users_id', Auth::user()->id);
    }

    public function updateTransaction(Request $request){
        $request->validate([
            'note'=>'required',
            'total'=>'required',
        ]);

        $data = $request->all();
        $transaction = update($data);
        return ResponseFormatter::success($transaction, 'Transaction Updated');
    }

    public function deleteTransaction(Request $request){
        
    }

}
