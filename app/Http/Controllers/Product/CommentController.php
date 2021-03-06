<?php

namespace App\Http\Controllers\Product;

use App\Entity\Product\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'comment'=>'required',
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        Comment::create($input);

        return back();
    }

    public function show()
    {

    }

    public function update(Request $request)
    {

    }

    public function delete(Comment $comment)
    {

    }

}
