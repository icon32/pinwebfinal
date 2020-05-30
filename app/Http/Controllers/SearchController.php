<?php

namespace App\Http\Controllers;

use Dotenv\Result\Result;
use Illuminate\Http\Request;
use App\Posts;
use App\User;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'query' => 'required|min:3',
        ]);

        $query = request('query');



        $posts = Posts::where('title','like',"%$query%")->get();
        $users = User::where('name','like',"%$query%")->get();

        $userscount = $users->count(); // counts how many users or products are in the variable
        $postscount = $posts->count();


//        dd($posts);
        return view('searchResults',['posts' => $posts,
            'users' => $users,
            'userscount' => $userscount,
            'postscount' => $postscount,
            ]);


    }

}