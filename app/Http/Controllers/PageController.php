<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Mail\OrderUp;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function differ() 
    {
        $role = auth()->user()->role;
        if($role !== 'admin') {
            return redirect()->route('page.index')->with(['message' => 'Welcome to eCom. Enjoy Shopping!']);
        }else {
            return redirect()->route('dashboard')->with(['message' => 'Welcome to Dashboard Panel!']);
        }
    }

    public function index() 
    {
        $products = Product::latest('id')->paginate(20)->withQueryString();
        return view('index', [
            'products' => $products,
        ]);
    }

    public function singleProduct(Product $id) 
    {
        $product = $id;
        $comments = Comment::latest()->get();
        $replies = Reply::latest()->get();
        $cReplies = Reply::latest()->get();
        return view('single-product', compact('product', 'comments', 'replies', 'cReplies'));
    }

    public function search(Request $request) 
    {   
        $search = $request->search;

        $products = Product::where( function($query) use ($search) {
            $query->where('name', 'like' ,'%'. $search .'%')
            ->orWhere('description', 'like', '%'. $search .'%')
            ->orWhere('price', 'like', '%'. $search .'%')
            ->orWhere('d_price', 'like', '%'. $search .'%');
        }) 
        ->paginate(20)->withQueryString();
        
        return view('index', compact('products'));
    }

    public function categorize(Request $request) {
        $key = $request->category;
        $category = Category::where(function($query) use ($key) {
            $query->where('name', 'like' ,'%'. $key .'%');
        }) 
        ->first();  
        $products = $category->products()->paginate(20)->withQueryString();

        return view('index', compact('products'));
    }

    public function addToCart(Request $request, Product $product) 
    {
        $request->validate([
            'quantity' => 'required|min:1|gt:0'
        ]);
        
        if(Cart::where('product_id', $product->id)->exists()) {
            $cart = Cart::where('product_id', $product->id)->first();
            $newQuantity = $cart->quantity + $request->quantity;
            $cart->update([
                'quantity' => $newQuantity
            ]);
        }else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

       return redirect()->back()->with(['message' => 'Product has been added to the cart']);
    }

    public function buyNow(Request $request, Product $product) 
    {
        $request->validate([
            'quantity' => 'required|min:1|gt:0'
        ]);

        if(Cart::where('product_id', $product->id)->exists()) {
            $cart = Cart::where('product_id', $product->id)->first();
            $newQuantity = $cart->quantity + $request->quantity; 
            $cart->update([
                'quantity' => $newQuantity
            ]);
        }else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

       return redirect()->route('checkout');
    }


    public function checkout() 
    {
        $carts = Cart::latest()->get();
        
        return view('checkout', compact('carts'));
    }

    public function removeCart(Cart $cart)
    {
        $cart->delete();
        return redirect()->back();
    }


    public function clearCart()
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        foreach($carts as $cart) {
            $cart->delete();
        }
        return redirect()->back()->with(['message' => 'Cart has been cleared!']);

    }
    
    public function cashOn() 
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        if($carts->count() == 0) {
            return redirect()->back()->with(['message' => 'You have nothing in the cart']);
        }
        foreach($carts as $cart) {
            $total = $cart->product->d_price ? $cart->product->d_price * $cart->quantity : $cart->product->price * $cart->quantity;
            Order::create([
                'product_id' => $cart->product_id,
                'price' => $cart->product->d_price ?? $cart->product->price,
                'quantity' => $cart->quantity,
                'total' => $total,
                'user_id' => auth()->id(),
                'payment_status' => 'Cash on delivery',
                'delivery_status' => 'Processing'
            ]);

            //clearing out cart
            $cart->delete();
        }

        //order up mail
        $admin = User::where('role', 'admin')->first();
        Mail::to($admin->email)->send(new OrderUp($admin));

        return redirect()->route('page.index')->with(['message' => 'Order has been sumbitted! Thanks for your purchase!']);
    }

    //to show user's orders
    public function userOrder() {
        $orders = request()->user()->orders()->where('delivery_status', 'processing')->latest()->get();
        // return $orders;
        return view('user-order', compact('orders'));
    }

    public function cancelOrder(Order $order) {
        $this->authorize('delete', $order);
        $order->delete();
        return back()->with(['message' => 'Your Order has been cancelled']);        
    }
}
