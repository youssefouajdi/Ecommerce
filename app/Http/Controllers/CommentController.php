<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;
use App\Prod;
use DB;
use App\User;
use App\Notifications\NewCommentPosted;
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
        $users = DB::select('select user_id from user_products where prod_id = ?', [$product->id]);
        $user = DB::select('select name from users where id = ?', [$users[0]->user_id]);
        $user->notify(new NewCommentPosted($product,auth()->user()));
        return redirect()->route('show',['product'=>$product->slug] );
    }
}
