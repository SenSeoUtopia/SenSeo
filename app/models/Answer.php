<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Answer extends Eloquent{

protected $table = "poll_answers";

protected $fillable = ['body', 'question_id'];

// Relationship
public function user(){
return $this->belongsTo('User');
}

// Relationship
public function question(){
return $this->belongsTo('Question');
}


}