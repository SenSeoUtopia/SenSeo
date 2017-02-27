<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class FriendRequest extends Eloquent {

protected $table = 'friend_request';


// Relationship
public function user(){
return $this->belongsTo('User','receiver_id');
}

// Get Unread Notifications
public function scopeUnread($query){
return $query->where('is_read', '=', 0);
}

}