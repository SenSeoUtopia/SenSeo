<?php

class LoginController extends Controller{

protected $tpl = 'layouts/login.htm';

function logout($f3){

$f3->clear('SESSION');

$f3->clear('logged_in');

$f3->clear('users');	

$f3->reroute('/');

}

// Show Login Page

function login($f3){

if($f3->get('SESSION.user')){
$f3->reroute('/');
}

$title = "Signin";

$site_key = $f3->get('recaptcha_key');

$f3->set('page',array('title'=>$title,'content'=>'login.htm','site_key'=>$site_key));
}

// Process Login Controller

function login_process($f3){

$data = $f3->get('POST');
$valid = Validate::is_valid($data, array(
'email' => 'required',
'password' => 'required'
));

if($valid === true) {

$user_name = $f3->get('POST.email');

$get_password = $f3->get('POST.password');

$user = User::where(['email' => $user_name])->first();

// Password Verify
if(password_verify($get_password,$user->password) ){

// Save Session
$f3->set('SESSION.user',$user);

$f3->reroute('/');

} else {
$title = 'Signin';

$errors = "Invalid Login Please Try Again.";

$f3->set('page',array('title'=>$title,'content'=>'login.htm','errors_login'=>$errors));
}


} else {
$title = 'Signin';

$errors = "Fill out all Fields.";

$f3->set('page',array('title'=>$title,'content'=>'login.htm','errors_login'=>$errors));
}

}





// Show Login Page

function admin_login($f3){

$title = "AdminCP Sign in";

$site_key = $f3->get('recaptcha_key');

$f3->set('page',array('title'=>$title,'content'=>'admin/login.htm','site_key'=>$site_key));
}

// Process Login Controller

function admin_login_process($f3){

$data = $f3->get('POST');
$valid = Validate::is_valid($data, array(
'email' => 'required',
'password' => 'required'
));

if($valid === true) {

$site_key = $f3->get('recaptcha_key');

$secret = $f3->get('recaptcha_secret');

$ip = $f3->get('IP');

$user_name = $f3->get('POST.email');

$get_password = $f3->get('POST.password');

$remember_me = ($f3->get('POST.remember')) ? $f3->get('POST.remember') : null;

$options = [
    'cost' => 12,
];

$user = User::where(['email' => $user_name])->first();

// Password Verify
if(password_verify($get_password,$user->password) ){
// Save Session
$f3->set('SESSION.user',$user);

$f3->reroute('/admincp');

} else {
$title = "AdminCP Sign in";

$errors = "Invalid Login Please Try Again.";

$f3->set('page',array('title'=>$title,'content'=>'admin/login.htm','errors_login'=> $errors));
}


} else {
$title = 'Signin';

$errors = "Fill out all Fields.";

$f3->set('page',array('title'=>$title,'content'=>'login.htm','errors_login'=>$errors));
}

}

}