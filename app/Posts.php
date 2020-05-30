<?php

namespace App;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{

    protected $table = "posts";
    protected $guarded = [];



    public function comments(){

        return $this->hasMany(Comments::class);

    }

//    public function like(){
//        $this->likes()->create([
//            'user_id' => auth()->id,
//            'liked' => true
//        ]);
//    }
//
//    public function unlike(){
//        $this->likes()->create([
//            'user_id' => auth()->id,
//            'liked' => false
//        ]);
//    }
//
//    public function isLikedBy(User $user){
//        return (bool) $user->likes->where('post_id',$this->id)->where('liked',true)->count();
//    }
//
//    public function isUnlikedBy(User $user){
//        return (bool) $user->likes->where('post_id',$this->id)->where('liked',false)->count();
//    }
//
//    public function likes(){
//
//        return $this->hasMany(Likes::class);
//
//    }
}
