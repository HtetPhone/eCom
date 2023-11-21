<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Mail\ProductDelivered;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;


class DashboardController extends Controller
{
    public function dashboard() 
    {
        $products = Product::all();
        $users = User::where('role', 'user')->get();
        $categories = Category::latest()->get();
        $orders = Order::all();
        return view('admin.dashboard', [
            'products' => $products,
            'users' => $users,
            'categories' => $categories,
            'orders' => $orders
        ]);
    }

    public function userList() 
    {
        $users = User::where('role', 'user')->latest()->get();
        return view('admin.users.users', compact('users'));
    }

    public function orderList() {
        $orders = Order::latest()->paginate(10)->withQueryString();
        return view('admin.users.orders', compact('orders'));
    }  

    public function deliever(Order $order)
    {
        $order->update([
            'delivery_status' => 'Delivered'
        ]);

        //delivery mail to user
        Mail::to($order->user)->send(new ProductDelivered($order));
         
        return back()->with(['message' => 'Deliverey has been made!']);
    }

    public function printOrder(Order $order)
    {
        $pdf = PDF::loadView('admin.pdf', compact('order'));
        return $pdf->stream('order_details.pdf');
    }

}
