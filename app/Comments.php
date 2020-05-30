<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Posts;

class Comments extends Model
{

    protected $table = "comments";

    public function posts(){

        return  $this->belongsTo(Posts::class);

    }
}
