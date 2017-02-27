<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Like extends Eloquent{

protected $table = "likes";

protected $fillable = ['post_id', 'user_id'];

// Relationship
public function user(){
return $this->belongsTo('User');
}

// Relationship
public function post(){
$this->belongsTo('Post');
}

}