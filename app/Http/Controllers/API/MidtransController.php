<?php

namespace App\Http\Controllers\API;

use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;

class MidtransController extends Controller
{

    public function callback(){
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');


        $notification = new Notification();

        $status = $notification->status;
        $type = $notification->type;
        $fraud = $notification->fraud;
        $order_id = $notification->order_id;

        $order = explode('-', $order_id);

        $transaction = Transaction::findOrFail($order[1]);

        if ($status == 'capture'){
            if($type == 'credit_card'){
                if($fraud == 'challenge'){
                    $transaction->status = 'PENDING';
                } else{
                    $transaction->status = 'SUCCESS';
                }
            }
        }

        else if($status == 'settlement' ){
            $transaction->status = 'SUCCESS';
        }

        else if($status == 'pending' ){
            $transaction->status = 'PENDING';
        }

        else if($status == 'deny' ){
            $transaction->status = 'PENDING';
        }

        else if($status == 'expire' ){
            $transaction->status = 'CANCELLED';
        }

        else if($status == 'cancelled' ){
            $transaction->status = 'CANCELLED';
        }

        $transaction->save();

        return response()->json([
            'meta' => [
                'code' => 200,
                'message' => 'Midtrans Notification Success!'
            ]
            ]);


    }

}
