<?php

class RegisterController extends Controller{

protected $tpl = 'layouts/login.htm';

function register($f3){

$title = "Sign up";

$site_key =  $f3->get('recaptcha_key');

$f3->set('page', array('title'=> $title,'content' => 'register.htm','site_key' => $site_key));
}

function register_process($f3){

$title = "Sign up";

$data = $f3->get('POST');

Validate::add_validator("same", function($field, $input, $param = NULL) {
    return $input[$field] === $input[$param];
});

$valid = Validate::is_valid($data, array(
'user_name' => 'required|alpha_numeric',
'display_name' => 'required|alpha_numeric',
'email' => 'required|email',
'gender' => 'required|integer',
'password' => 'required|max_len,10|min_len,6',
'password_confirmed' => 'required|same,password'
));

if($valid === true) {

$user_name = $f3->get('POST.user_name');

$first_name = $f3->get('POST.first_name');

$last_name = $f3->get('POST.last_name');

$display_name = $f3->get('POST.display_name');

$gender = $f3->exists('POST.gender') ? $f3->get('POST.gender') : 0;

$date_of_birth = $f3->get('POST.date_of_birth');

$email = $f3->get('POST.email');

$password = password_hash($f3->get('POST.password'), PASSWORD_DEFAULT);

$active = 1;

$activation_key = str_random(30);

// Connect Database
try {
$db = new DB\SQL($f3->get('db_dns') . $f3->get('db_name'), $f3->get('db_user'), $f3->get('db_pass'));
} catch (PDOException $e) {
$msg = "Error establishing a database connection";
}

$user = new User($db);
$user->user_name = $user_name;
$user->display_name = $display_name;
$user->email = $email;
$user->password = $password;
$user->date_of_birth = $date_of_birth;
$user->gender = $gender;
$user->activation_key = $activation_key;
$user->pic = "";
$user->active = $active;
$user->is_admin = $is_admin;

if($user->save()){
$f3->reroute("/login");
} else {

$errors = "Unable to create Administrator Account";

$f3->set("page",array('content' => 'register.htm','title' => $title,'errors' => $errors));

}

} else {

$errors = "Complete All Fields";

$f3->set("page",array('content' => 'register.htm','title' => $title,'errors' => $errors));

}


}

}