<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Illuminate\Support\Facades\Storage;
use App\Likes;


class PostsController extends Controller
{

    public function index()
    {

        $posts = Posts::latest()->get();

        return  view('pinhome',[ 'posts' => $posts ]);
    }


    public function create()
    {

        return view('newpost');
    }

    public function show($slug)
    {

        $currentuser = auth()->user();
        $posts = Posts::where('slug', $slug)->first();
        $users = User::all();


        //Like Implementation

        if($currentuser != null) {   // if there is no user bring no likes

            $likes = Likes::where('post_id',$posts->id)->where('user_id',$currentuser->id )->first();

            if(!$likes){
                $likes = null;
            }

        }else{
            $likes = null;
        }


        if (! $posts){
            abort(404);
        }



      return view('singlepost', ['posts' => $posts, 'user'=> $currentuser, 'users' => $users , 'likes' => $likes]);
    }

    //Create a New Comment
    public function createcomment()
    {

        request()->validate([
            'comment' => 'required',
        ]);

        $comment = request('comment');
        $post_id = request('post_id');
        $currentuser = auth()->user();
        $posts = Posts::find($post_id);


        $newcomment = new Comments();
        $newcomment->body = $comment;
        $newcomment->user_id = $currentuser->id;
        $newcomment->user_name = $currentuser->name;
        $newcomment->user_avatar = $currentuser->avatar;


        $posts->comments()->save($newcomment);




        return redirect('/posts/'.$posts->slug);



    }

    //Create a New Post
    public function store(Request $request)
    {
//        dd($request);
        //Validation
        request()->validate([
            'title' => 'required|max:65',
            'body' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,ico'
        ]);



        $posts = new Posts();
        $user = Auth::user();

        if ($upimage = $request->file('image')){ //Bring the file in and test if there is one

           if(!$upimage->move(public_path('/img/posts/'),$upimage->getClientOriginalName())){ //Testing if file uploaded
               return 'Problem';

           }else{
               $posts->image = $upimage->getClientOriginalName() ; //write the file to database
           }

        }

        // Checking For Duplicated Title - Start

     //*When you create an article if the name exists it will put a -2 if not it will continue
     //*
     //*
        $title = $request->title;
        $duplicate = Posts::where('title', $title)->get();
        $dupnumber = 0;
        foreach ($duplicate as $dup) {
            $dupnumber ++;
        };
        if ($dupnumber == 0){
            $posts->title = request('title'); //store title
            $posts->slug = request('title');
        }else {
            $posts->title = request('title').'-2'; //store title
            $posts->slug = request('title').'-2';
        }

        // Checking For Duplicated Title - Start

        $myday = date('D-m-y'); //Seting Curent Time (2 hours Behind Greek Time)


            //store slug
            $posts->body = request('body'); // store the body
            $posts->created_at = $myday;
            $posts->updated_at = $myday;
            $posts->total_likes = 0;
            $posts->total_comments = 0;
            $posts->user_id = $user->id;



        $posts->save();
        return redirect('/posts/'.$posts->slug);
    }

    //Redirect to Post Edit Page
    public function edit($slug)
    {
        $posts = Posts::where('slug', $slug)->first();

        return view('editpost',['posts' => $posts]);
    }

    //Edit a Post
    public function update($slug)
    {

        $posts = Posts::where('slug', $slug)->first();
        $myday = date('D-m-y');

        //Validation
        request()->validate([
            'title' => 'required|max:65',
            'body' => 'required',
            'image' => 'mimes:jpg,png,jpeg,gif,ico'
        ]);

        // Change Image - Start
        $image = request('image');
        if($image) {
            $imagename = $image->getClientOriginalName(); //write the file to database
            $image->move(public_path('/img/posts/'), $imagename);
            $posts->image = $imagename;
        }
        // CChange Image - End

        // Checking For Duplicated Title - Start

        //*When you create an article if the name exists it will put a -2 if not it will continue
        //*The reason for the numerical test is that every time it scans the tatabase at line 173 it will find it's self
        //* and eaven after the code runs it deletes it the name has an extra -2 this way it does not
        //* Plus if it finds a post which is more than 2 times then it puts the -2

        $post_title = request('title');
        $duplicate = Posts::where('title', $slug)->get();
        $dupnumber = 0;

        foreach ($duplicate as $dup) {
            $dupnumber ++;
        };
        if ($dupnumber == 1){
            $posts->title = request('title'); //store title
            $posts->slug = request('title');
        }else {
            $posts->title = request('title').'-2'; //store title
            $posts->slug = request('title').'-2';
        }

        // Checking For Duplicated Title - Start



        $posts->body = request('body'); // store the body
        $posts->updated_at = $myday;
        $posts->save();

        return redirect('/posts/'.$posts->slug);

    }

    // Delete Post
    public function destroy($slug)
    {
        $posts = Posts::where('slug', $slug)->first();
        $user = Auth::user();

        if ($user->id == $posts->user_id){
        $posts->delete();
        return redirect('/');
        }
    }



}
