<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Post extends Eloquent{

protected $table = "posts";

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

// Album
public function album(){
return $this->hasMany('Album');
}

// Photos
public function photos(){
return $this->hasMany('Photo');
}

}