<?php

class AdminController extends Controller{
	
protected $tpl = 'layouts/admincp.htm';


public function beforeRoute($f3){

$auth = $f3->get('SESSION.user');

if(empty($auth)){
$f3->reroute('/admincp/login');
}

if(empty($auth->is_admin)){
$f3->reroute('/');
}
}

// Show Dashboard

public function dashboard($f3){

$title = 'AdminCP';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));

}


}