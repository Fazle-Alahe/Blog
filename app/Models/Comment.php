<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function rel_to_viewer(){
        return $this->belongsTo(Viewer::class, 'commentor_id');
    }

    function rel_to_blog(){
        return $this->belongsTo(Blog::class, 'post_id');
    }

}
