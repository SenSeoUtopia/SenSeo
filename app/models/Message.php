<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class Message extends Eloquent {

protected $table = 'messages';

// Relationship
public function user(){
return $this->belongsTo('User');
}

// Get Unread Notifications
public function scopeUnread($query){
return $query->where('is_read', '=', 0);
}


}