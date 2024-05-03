<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    
    function rel_to_category(){
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }

    function rel_to_user(){
        return $this->belongsTo(User::class, 'blogger_id');
    }
    
    function rel_to_tag(){
        return $this->belongsTo(Tag::class, 'tags');

    }
}
