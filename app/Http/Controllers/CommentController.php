<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'comment' => 'required|min:2'
        ], [
            'comment.required' => 'Write something to comment',
        ]);

        $request->user()->comments()->create([
            'comment' => $request->comment,
            'product_id' => $product->id,
        ]);

        return back();
    }
}
