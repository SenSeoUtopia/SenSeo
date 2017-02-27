<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class PollHistory extends Eloquent{

protected $table = "poll_voting_history";

protected $fillable = ['user_id', 'question_id', 'answer_id'];

// Relationship
public function user(){
return $this->belongsTo('User');
}

// Relationship
public function question(){
return $this->belongsTo('Question');
}

// Relationship
public function answer(){
return $this->belongsTo('Answer');
}


}