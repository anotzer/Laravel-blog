<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Commentary extends Model
{
    //
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(BlogPost::class);
    }
}
