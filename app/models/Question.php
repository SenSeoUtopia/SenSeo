<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Question extends Eloquent{

protected $table = "poll_questions";

protected $fillable = ['body','user_id'];

// Relationship
public function answer(){
return $this->hasMany('Answer');
}

// Photos
public function user(){
return $this->belongsTo('User');
}

}