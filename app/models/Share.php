<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Share extends Eloquent{

protected $table = "shares";

// Relationship
public function user(){
return $this->belongsTo('User');
}


}