<?php
class ProfileController extends Controller{

protected $tpl = 'layouts/profile.htm';

public function beforeroute($f3,$args){

$user_name = $args['user_name'];

$user = User::where("user_name",$user_name)->first();

if(!$user){

$f3->reroute('/');

} else {

$f3->set('profile_users',$user);
$f3->set('user_profile_page',true);

}	

}

/* Home Page */
public function show_profile($f3,$args){

$user = $f3->get("profile_users");

$user_name = $user->display_name;

$user_id = $user->id;

$title = "Profile : $user_name";

$post_list = Post::with('album','photos')->where("user_id",$user_id)->orderBy("created_at","desc")->get();

$f3->set("post_list",$post_list);

$f3->set("page",array('content' => 'profile/home.htm','title' => $title));


}

/* Home Page */
public function show_friends($f3,$args){

$user = $f3->get("profile_users");

$user_name = $user->display_name;

$user_id = $user->id;

$title = "Profile : $user_name";

$friend_list = isset($user->friends) ? $user->friends : null;

$f3->set("friend_list",$friend_list);

$f3->set("page",array('content' => 'profile/friends.htm','title' => $title));


}

/* Photos */
public function show_photos($f3,$args){

$user_name = $args['user_name'];

$user = $f3->get("profile_users");

$user_id = $user->id;

$user_name = $user->display_name;

$title = "Profile : $user_name Photos";

$album = Album::all();

$f3->set("album_list",$album);

$f3->set("page",array('content' => 'profile/photos.htm','title' => $title));
}

/* Album */
public function album($f3,$args){

$user_name = $args['user_name'];

$title = "Profile : $user_name Photos";

$album_title = $f3->get("POST.title");
$album_summary = $f3->exists("POST.summary") ? $f3->get("POST.summary") : "";

$user = $f3->get("profile_users");

$user_id = $user->id;

$album = Album::firstornew(["user_id" => $user_id,"title" => $album_title]);
$album->summary = $album_summary; 

if($album->save()){
	
$album_id = $album->id;	
	
$upload_dir = $this->upload_dir;

if(!is_dir("$upload_dir/$user_id/album/$album_id")){
mkdir("$upload_dir/$user_id/album/$album_id");
}	
	
$msg = array("success" => true, "msg" => "Album has been Created Successfully");	
	
$f3->set("page",array('content' => 'profile/photos.htm','title' => $title,'msg' => $msg));
} else {
	
$msg = array("success" => false, "msg" => "Unable to Create Album");
	
$f3->set("page",array('content' => 'profile/photos.htm','title' => $title,'msg' => $msg));
}

}

// Album Upload Photos
public function album_photos($f3,$args){

$user_name = $args['user_name'];

$album_id = $args['id'];

$title = "Add Photo to Album";

$album = Album::all();

$f3->set("album_list",$album);

$f3->set("page",array('content' => 'profile/photos_create.htm','title' => $title,'album' => $album_id));
}

/* Videos */
public function show_videos($f3,$args){

$user_name = $args['user_name'];

$user = $f3->get("profile_users");

$user_id = $user->id;

$user_name = $user->display_name;

$title = "Profile : $user_name Videos";

$f3->set("page",array('content' => 'profile/photos.htm','title' => $title));


}

/* Profile Post View */
public function post_view($f3,$args){

$valid = Validate::is_valid($args, array(
'user_name' => 'required|alpha_numeric',
'id' => 'required|integer'
));

if($valid === true) {

$user_name = $args['user_name'];

$post_id = $args['id'];

$user = $f3->get("profile_users");

$user_id = $user->id;

$user_name = $user->display_name;

$post = Post::where(array("id" => $post_id,"user_id" => $user_id))->first();

$title = "Profile : $user_name Post #$post_id";

$f3->set("post",$post);

$f3->set("page",array('content' => 'profile/post_view.htm','title' => $title));
} else {

$f3->set("page",array('content' => '404.htm','title' => "Opps: 404 Error : Not Found"));
}

}


/* Edit Profile */
public function edit_profile($f3,$args){

$user = $f3->get("profile_users");

$user_name = $user->display_name;

$user_id = $user->id;

$title = "Edit Profile : $user_name";

$f3->set("edit_user",$user);

$f3->set("page",array('content' => 'profile/edit.htm','title' => $title));
}

/* Process Edit Profile */
public function edit_profile_process($f3,$args){

$user = $f3->get("profile_users");

$user_name = $user->display_name;

$user_id = $user->id;

$title = "Edit Profile : $user_name";

$f3->set("page",array('content' => 'profile/edit.htm','title' => $title));
}


/* Change Password */
public function change_password($f3,$args){

$user = $f3->get("profile_users");

$user_name = $user->display_name;

$title = "Change Password : $user_name";

$f3->set("page",array('content' => 'profile/change_password.htm','title' => $title));
}

/* Change Password Process */
public function change_password_process($f3,$args){

$user = $f3->get("profile_users");

$user_name = $user->display_name;

$user_id = $user->id;

$title = "Change Password : $user_name";

$current_password = $f3->get("POST.current_password");

$new_password = $f3->get("POST.password");

$msg = "";

if($current_password === $new_password){

$msg .= "Password did not change because new password is same as old password"; 
	
} else {

if(password_verify($current_password,$user->password)){

$user = User::find($user_id);
$user->password = password_hash();
if($user->save()){ $success_msg .= "Password has been Updated Successfully"; } else { $msg .= "Unable to Update Password"; }
} else { 
$msg .= "Current Password does not match";
}

}





$f3->set("page",array('content' => 'profile/change_password.htm','title' => $title,"success" => $success_msg,"error" => $msg));
}




/* Messages */
public function messages_profile($f3,$args){

$user = $f3->get("profile_users");

$user_name = $user->display_name;

$user_id = $user->id;

$title = "Messages : $user_name";

$f3->set("page",array('content' => 'profile/msg.htm','title' => $title));
}

/* Notification */
public function notification_profile($f3,$args){

$user = $f3->get("profile_users");

$user_name = $user->display_name;

$user_id = $user->id;

$title = "Notification : $user_name";

$f3->set("page",array('content' => 'profile/msg.htm','title' => $title));
}

/* Friend Request */
public function friend_request_profile($f3,$args){

$user = $f3->get("profile_users");

$user_name = $user->display_name;

$user_id = $user->id;

$title = "Friend Requests : $user_name";

$f3->set("page",array('content' => 'profile/msg.htm','title' => $title));
}

}