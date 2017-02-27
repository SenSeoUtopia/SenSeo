<?php

class UsersController extends AdminController{
	
protected $tpl = 'admincp.htm';

// Show Dashboard

public function dashboard($f3){

$title = 'AdminCP';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));

}


}