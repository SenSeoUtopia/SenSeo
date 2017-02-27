<?php

class Controller {

protected $f3;
protected $db;
protected $base_dir;
protected $cover_dir;
protected $upload_dir;
protected $app_dir;
protected $public_dir;
protected $home_url;
protected $tpl;

function __construct() {

$f3 = Base::instance();
$this->f3 = $f3;

$this->home_url = $f3->get('SCHEME').'://'.$f3->get('HOST').$f3->get('BASE');

if(!$f3->get('installed')){
$f3->reroute('install');
}

// Base Dir
$this->base_dir = $f3->get('base_dir');

// Covers Dir
$this->cover_dir = $f3->get('cover_dir');

// Covers Dir
$this->upload_dir = $f3->get('upload_dir');

// App Dir
$this->app_dir = $f3->get('app_dir');

// Public Path
$this->public_dir = $f3->get('public_dir');
}


// Show Error
function error($f3){
throw new RuntimeException("Something went Wrong.");
}

// Set Data
function afterroute($f3) {
$site_title = $f3->get('site_title');
$active_menu = $f3->get('PATH');
$home_url = $this->home_url;
$f3->set('site_title',$site_title);
$f3->set('home_url',$home_url);
$f3->set('active_menu',$active_menu);
$maintenance = $f3->get('maintenance');
if($maintenance){
$f3->status(503);
echo Template::instance()->render('503.htm');
exit;
}

// Check Login
$get_auth = $f3->get('SESSION.user');

if($get_auth){

$f3->set('logged_in',true);

$f3->set('users',$get_auth);	

}


if(isset($this->tpl)){
/* Register Filters */
$preview = Template::instance();
$preview->filter('crop','Helper::instance()->crop');
$preview->filter('striptags','Helper::instance()->striptags');
$preview->filter('remove_slash','Helper::instance()->remove_slash');
$preview->filter('remove_spaces','Helper::instance()->remove_spaces');
$preview->filter('replace_data','Helper::instance()->replace_data');
echo $preview->render($this->tpl);

}

}

}