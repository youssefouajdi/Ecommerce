<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;
use App\Prod;
class CommentController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }
    public function store(Prod $product)
    {
        request()->validate([
            'content'=>'required:5'
        ]);
        $comment=new Comment();
        $comment->content= request('content');
        $comment->user_id= auth()->user()->id;
        $product->comments()->save($comment);
        
        return redirect()->route('show',['product'=>$product->slug] );
    }
}
