<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Posts;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index()
    {
        return view('/');
    }


    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $userid = $user->id;
        $posts = Posts::where('user_id',$userid)->paginate(5);

        $authuser = Auth::user();

        if($authuser == null){
            $currentuser = 3000;
        }else{
            $currentuser =  $authuser->id;
        }


        if (! $user){
            abort(404);

        }
        return view('profile',['user' => $user,'posts' => $posts,'currentuser' => $currentuser]);
    }





    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $posts = Posts::where('user_id', $id)->get();
        if (! $user){
            abort(404);

        }
        return view('editprofile',['user' => $user,'posts'=> $posts]);
    }


    public function update($id)
    {

    }


    public function destroy($id)
    {
        //
    }

    public function editname($name){

        $user = User::where('id',Auth::id())->first();
        //dd($user->description);
        $user->name = request('name');

        //$user->description = request('description');

        $user->save();

        return redirect("/profile/" . $user->id);
    }

    public function editdescription(){

       // dd($description);
        $user = User::where('id', Auth::id())->first();
        $user->description = request('description');
        $user->save();

        return redirect("/profile/" . $user->id );
    }

    public function editavatar(){

        $user = User::where('id', Auth::id())->first();


        $image = request('avatar');
        //dd($image);
        if($image) {
            $imagename = $image->getClientOriginalName(); //write the file to database
            $image->move(public_path('/img/users/'), $imagename);
            $user->avatar = $imagename;
        }

        $user->save();

        return redirect("/profile/" . $user->id );
    }



}
