<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Album extends Eloquent{

protected $table = "album";

protected $fillable = ['title', 'user_id'];

// Relationship
public function user(){
return $this->belongsTo('User');
}

// Photos
public function photos(){
return $this->hasMany('Photo');
}

// Photos
public function posts(){
return $this->belongsTo('Post');
}

}