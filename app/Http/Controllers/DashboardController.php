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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller
{
    public function dashboard() 
    {
        $products = Product::all();
        $users = User::where('id', '>', 1)->get();
        $categories = Category::latest()->get();
        $orders = Order::all();
        return view('admin.dashboard', [
            'products' => $products,
            'users' => $users,
            'categories' => $categories,
            'orders' => $orders
        ]);
    }

    //users
    public function userList() 
    {
        $users = User::where('id', '>', 1)->latest()->paginate(30)->withQueryString();
        return view('admin.users.users', compact('users'));
    }

    public function userCreate()
    {
        return view('admin.users.users-create');
    }

    public function userStore(Request $request)
    {
        $formData = $request->validate([
            'name' => 'required|min:3',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Password::defaults()],
            'role' => 'required',
        ], [
            'role.required' => 'A role must be choosen for user',
        ]);

        User::create($formData);

        return redirect()->route('users.list')->with(['message' => 'A new user has been added!']);
    }

    public function userEdit(User $user){
        return view('admin.users.users-edit', compact('user'));
    }

    public function userUpdate(Request $request, User $user){
        $formData = $request->validate([
            'name' => 'required|min:3',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,id,'. $user->id],
            'role' => 'required',
        ], [
            'role.required' => 'A role must be choosen for user',
        ]);

        $user->update($formData);

        return back()->with(['message' => 'User has been updated']);
    }

    public function userRemove(User $user){
       
        $user->delete();
        return back()->with(['message' => 'User has been removed']);
    }


    //orders
    public function orderList() {
        $orders = Order::latest()->paginate(20)->withQueryString();
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

    public function orderSearch(Request $request) 
    {
        $key = $request->key;
        $orders = Order::where(function($query) use ($key) {
            $query->where('price', 'like', '%' . $key .'%')
            ->orWhere('total', 'like', '%' . $key .'%')
            ->orWhere('quantity', 'like', '%' . $key .'%');
        })
        ->orWhereHas('product', function (Builder $query) use ($key) {
            $query->where('name', 'like', '%' . $key .'%');
        })->orWhereHas('user', function($query) use ($key) {
            $query->where('name', 'like', '%' . $key .'%');
        })
        ->paginate(20)->withQueryString();

        return view('admin.users.orders', compact('orders'));

    }

    public function orderCategorize(Request $request) 
    {
        if($request->status == 'status_p') {
            $orders = Order::where('payment_status','Paid')->paginate(20)->withQueryString();
        }else {
            $orders = Order::where('payment_status','Cash on delivery')->paginate(20)->withQueryString();
        }

        return view('admin.users.orders', compact('orders'));
    }

}
