<?php
class HomeController extends Controller{

protected $tpl = 'layouts/base.htm';

/* Home Page */
public function dash($f3){

$title = "Home";

if($f3->get('SESSION.user')){

$f3->set("page",array('content' => 'dashboard.htm','title' => $title));

} else {

$f3->set("page",array('content' => 'home.htm','title' => $title));

}

}


}