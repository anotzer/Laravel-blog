<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

/**
 * Class BlogPost
 * @package App\Models
 */
class BlogPost extends Model
{
    //
    use SoftDeletes;


    const UNKNOWN_USER = 1;
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content_raw',
        'is_published',
        'published_at',
        'user_id',
    ];
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(){
        //belongsTo принадлежит
        return $this->belongsTo(BlogCategory::class);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /**public function user(){
        return $this->belongsTo(User::class);
    }*/

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function commentaries()
    {
        return $this->hasMany(Commentary::class);
    }

}
