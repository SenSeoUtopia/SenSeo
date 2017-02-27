<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Photo extends Eloquent{

protected $table = "photos";

protected $fillable = ['file_name', 'user_id'];

// Relationship
public function user(){
return $this->belongsTo('User');
}

// Comment Relationship
public function comments(){
return $this->hasMany('Comment');
}

// Likes Relationship
public function likes(){
return $this->hasMany('Like');
}

// Share Relationship
public function share(){
return $this->hasMany('Share');
}

// Photos
public function posts(){
return $this->hasMany('Post');
}

// Photos
public function album(){
return $this->belongsTo('Album');
}

}