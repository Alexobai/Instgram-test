<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    //this user() connect to the User model
    public function profileImage()
    {
        return ($this->image) ? '/storage/' .$this->image:'https://aliceasmartialarts.com/wp-content/uploads/2017/04/default-image.jpg';
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
