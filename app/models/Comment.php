<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Comment extends Eloquent{

protected $table = "posts";

// Relationship
public function user(){
return $this->belongsTo('User');
}


}