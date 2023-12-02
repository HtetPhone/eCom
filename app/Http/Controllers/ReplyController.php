<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {

        // return $request;
        $formData = $request->validate([
            'reply' => 'required|min:2',
            'parent_id' => 'required'
        ]);

        $formData['user_id'] = auth()->id();

        Reply::create($formData);

        return back();

    }
}
