<?php

namespace App\Http\Controllers;

use App\Likes;
use App\Posts;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{

    // Like on a Post
    public function  postliked(){

        $post_id = request('post_id');

        $currentuser = Auth::user();
        $posts = Posts::where('id',$post_id)->first();
//        $myday = date('D-m-y'); //Seting Curent Time (2 hours Behind Greek Time)


        $likes = new Likes();

        $likes->user_id = $currentuser->id;
        $likes->created_at = null;
        $likes->updated_at = null;
        $likes->post_id = $post_id;

        $likes->save();

//        $currentuser->total_likes = $currentuser->total_likes + 1;

        $posts->total_likes = $posts->total_likes + 1;
        $posts->save();
        $currentuser->total_likes = $currentuser->total_likes +1;
        $currentuser->save();


        $currentlikes = $posts->total_likes;

        return  $currentlikes;
//        return redirect('/posts/'.$posts->slug);    Old Like System
    }



    // Undo a Like on a Post
    public function  postunliked(){

        $post_id = request('post_id');
        $currentuser = Auth::user();
        $posts = Posts::where('id',$post_id)->first();
//        $myday = date('D-m-y'); //Seting Curent Time (2 hours Behind Greek Time)


        $likes = Likes::where('post_id',$post_id)->where('user_id',$currentuser->id)->first();

        $likes->delete();

//        $currentuser->total_likes = $currentuser->total_likes + 1;

        $posts->total_likes = $posts->total_likes - 1;
        $posts->save();
        $currentuser->total_likes = $currentuser->total_likes - 1;
        $currentuser->save();


        $currentlikes = $posts->total_likes;

        return $currentlikes;
    }
}
