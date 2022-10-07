<?php

namespace App\Http\Controllers;

use Exception;
use Midtrans\Snap;
use App\Models\Cart;
use Midtrans\Config;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutRequest;


class FrontController extends Controller
{
    public function index(Request $request){
        $product = Product::with(['galleries'])->latest()->get();
        return view('pages.front.index',compact('product'));
    }

    public function details(Request $request, $slug){
        $product = Product::with(['galleries'])->where('slug',$slug)->firstOrFail();
        return view('pages.front.details',compact('product'));
    }

    public function cart(Request $request){
        $carts = Cart::with(['product.galleries'])->where('users_id',Auth::user()->id)->get();
        return view('pages.front.cart',compact('carts'));
    }
    public function cartAdd(Request $request, $id){
        Cart::create([
            'users_id' => Auth::user()->id,
            'products_id' => $id
        ]);
        return redirect('cart');
    }

    public function cartDel(Request $request, $id){
        $item = Cart::findOrFail($id);

        $item->delete();
        return redirect('cart');
    }

    public function checkout(CheckoutRequest $request){
        $data = $request->all();

        $carts = Cart::with(['product'])->where('users_id',Auth::user()->id)->get();

        $data['users_id'] = Auth::user()->id;
        $data['total_price'] = $carts->sum('product.price');

        $transaction = Transaction::create($data);

        foreach ($carts as $cart) {
            $items[] = TransactionItem::create([
                'transactions_id' => $transaction->id,
                'users_id' => $cart->users_id,
                'products_id' => $cart->products_id
            ]);
        }

        Cart::where('users_id', Auth::user()->id)->delete();

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $midtrans=[
            'transaction_details' =>[
                'order_id' => 'MPROP' . $transaction->id,
                'gross_amount' => (int) $transaction->total_price
            ],
            'customer_details' =>[
                'first_name' => $transaction->name,
                'email' => $transaction->email
            ],
            'enabled_payments' => ['gopay','bank_transfer','shopeepay'],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();
            
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
          }
          catch (Exception $e) {
            echo $e->getMessage();
          }

    }

    public function success(Request $request){
        return view('pages.front.success');
    }

    public function logs(){
        Auth::guard('web')->logout();
        return redirect('/');
    }

}
