<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
        /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

     public function stripe(Request $request)

     {
        $total_amount = $request->total_amount;
        return view('stripe', compact('total_amount'));
        
     }
 
     
 
     /**
 
      * success response method.
 
      *
 
      * @return \Illuminate\Http\Response
 
      */
 
     public function stripePost(Request $request, $total_amount)
 
     {
 
        Stripe::setApiKey(env('STRIPE_SECRET'));
 
     
 
        Charge::create ([
 
                 "amount" => $total_amount * 100,
 
                 "currency" => "usd",
 
                 "source" => $request->stripeToken,
 
                 "description" => "Test payment with Stripe" 
 
        ]);
 
       
 
        Session::flash('success', 'Payment successful!');
 
        //clean out the carts       
        $carts = Cart::where('user_id', auth()->id())->get();
        foreach($carts as $cart) {
            $total = $cart->product->d_price ? $cart->product->d_price * $cart->quantity : $cart->product->price * $cart->quantity;
            Order::create([
                'product_id' => $cart->product_id,
                'price' => $cart->product->d_price ?? $cart->product->price,
                'quantity' => $cart->quantity,
                'total' => $total,
                'user_id' => auth()->id(),
                'payment_status' => 'Paid',
                'delivery_status' => 'Processing'
            ]);

            //clearing out cart
            $cart->delete();
        }

        return redirect()->route('checkout')->with(['message' => 'Order has been sumbitted!']);
     }
}
