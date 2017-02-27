<?php
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent {

protected $table = "users";

// Relationship Post
public function post(){
return $this->hasMany("Post");
}

// Relationship Photos
public function photos(){
return $this->hasMany("Photo");
}

// Relationship Comments
public function comments(){
return $this->hasMany("Comment");
}

// Relationship Notification
public function notifications(){
return $this->hasMany("Notification","user_id");
}

// Relationship Messages
public function messages(){
return $this->hasMany("Message","receiver_id");
}

// Relationship Friends
public function friends(){
return $this->hasMany("Friend");
}

// Relationship Friends
public function friend_request(){
return $this->hasMany("FriendRequest","receiver_id");
}

// Relationship Friends
public function questions(){
return $this->hasMany("Question");
}

// Relationship Friends
public function answers(){
return $this->hasMany("Answer");
}

}