<?php
use Intervention\Image\ImageManager;

class ImageController extends Controller{


// Minify Css, Js
public function minify($f3, $args) {

$f3_root = $this->public_dir;

$path = $f3_root.'/'.$args['type'].'/';

$files = str_replace('../','',$_GET['files']); // close potential hacking attempts  
echo Web::instance()->minify($files, null, true, $path);
}



/* Avatar Upload */
public function avatar($f3){
	
$data = $f3->get("POST");

$home_url = $this->home_url;

$upload_dir = $this->upload_dir;

$get_user = $f3->get("SESSION.user");

$user_id = $get_user->id;

$image_url = $data['imgUrl'];

// resized sizes
$imgW = $data['imgW'];
$imgH = $data['imgH'];
// offsets
$imgY1 = $data['imgY1'];
$imgX1 = $data['imgX1'];
// crop box
$cropW = $data['cropW'];
$cropH = $data['cropH'];
// rotation angle
$angle = $data['rotation'];

$image_info = getImageSize($image_url);
switch ($image_info['mime']) {
case 'image/gif':
$extension = 'gif';
break;
case 'image/jpeg':
$extension = 'jpg';
break;
case 'image/png':        
$extension = 'png';
break;
default:
break;
}

$file_name = "avatar";

$destination = "$upload_dir/$user_id/profile_pics/$file_name.$extension";

$avatar_url = "$home_url/uploads/$user_id/profile_pics/$file_name.$extension";


$manager = new ImageManager(array('driver' => 'imagick'));

$image = $manager->make($image_url)->resize($imgW, $imgH)->crop($cropW,$cropH, $imgX1, $imgY1)->save($destination);

$user = User::find($user_id);

$user->avatar = $avatar_url;

$user->save();
	
if( !$image) {

return Response::json(['status' => 'error','message' => 'Server error while uploading'], 200);

}

return Response::json(['status' => 'success','url' => $avatar_url], 200);
}

/* Cover Upload */
public function cover($f3){

$data = $f3->get("POST");

$home_url = $this->home_url;

$upload_dir = $this->upload_dir;

$get_user = $f3->get("SESSION.user");

$user_id = $get_user->id;

$file_name = "cover";

$image_url = $data['imgUrl'];

// resized sizes
$imgW = $data['imgW'];
$imgH = $data['imgH'];
// offsets
$imgY1 = $data['imgY1'];
$imgX1 = $data['imgX1'];
// crop box
$cropW = $data['cropW'];
$cropH = $data['cropH'];
// rotation angle
$angle = $data['rotation'];

$image_info = getImageSize($image_url);
switch ($image_info['mime']) {
case 'image/gif':
$extension = 'gif';
break;
case 'image/jpeg':
$extension = 'jpg';
break;
case 'image/png':        
$extension = 'png';
break;
default:
break;
}

$destination = "$upload_dir/$user_id/covers/$file_name.$extension";
$small_cover = "$upload_dir/$user_id/covers/small_cover.$extension";

$time = time();

$cover = "$home_url/uploads/$user_id/covers/$file_name.$extension?$time";


$manager = new ImageManager(array('driver' => 'imagick'));

$image = $manager->make($image_url)->resize($imgW, $imgH)->crop($cropW,$cropH, $imgX1, $imgY1)->save($destination);

$user = User::find($user_id);

$user->cover = $cover;

$user->save();
	
if( !$image) {

return Response::json(['status' => 'error','message' => 'Server error while uploading'], 200);

}

return Response::json(['status' => 'success','url' => $cover], 200);

}

/* Cover Upload */
public function ajax_photo_save($f3){

$file_list = $f3->get("FILES");

$destination = "$upload_dir/$user_id/covers/$file_name.$extension";
$small_cover = "$upload_dir/$user_id/covers/small_cover.$extension";

$cover = "$home_url/uploads/$user_id/covers/$file_name.$extension";


$manager = new ImageManager(array('driver' => 'imagick'));

$image = $manager->make($image_url)->resize($imgW, $imgH)->crop($cropW,$cropH, $imgX1, $imgY1)->save($destination);


	
if( !$image) {

return Response::json(['status' => 'error','message' => 'Server error while uploading'], 200);

}

return Response::json(['status' => 'success','url' => $cover], 200);

}

}