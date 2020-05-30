<?php

namespace App\Http\Controllers;

use App\Comments;
use Illuminate\Http\Request;
use Illuminate\Auth;
use App\Posts;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{

    public function index()
    {


    }



    public function create(Request $request)
    {


        request()->validate([
            'comment' => 'required',
        ]);

        $comment = request('comment');
        $post_id = request('post_id');
        $myday = date('D-m-y'); //Seting Curent Time (2 hours Behind Greek Time)
        $currentuser = auth()->user();
        $posts = Posts::where('id', $post_id)->first();

        $comments = new Comments();

        $comments->body = $comment;
        $comments->user_id = $currentuser->id;
        $comments->post_id = $post_id;
        $comments->created_at = $myday;
        $comments->updated_at = $myday;
        $comments->post()->associate($post_id);
        $comments->save();

        return redirect('/posts/'.$posts->slug);



    }


    public function store(Request $request)
    {
        //
    }


    public function show(Comments $comments)
    {
        //
    }


    public function edit(Comments $comments)
    {
        //
    }


    public function update(Request $request, Comments $comments)
    {
        //
    }


    public function destroy(Comments $comments)
    {
        //
    }
}
