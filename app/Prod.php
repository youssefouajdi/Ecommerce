<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prod extends Model
{
    public function getPrice(){
        $price =$this->price/100;
        return number_format($price,2,',',' ').' MAD';
    }
    public function categories(){
        return $this->belongsToMany('App\Category');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
   public function comments()
   {
       return $this->morphMany('App\Comment','commentable')->latest();
   }
}